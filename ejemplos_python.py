"""
Ejemplos de consumo de Zodiac API con Python
Ejecutar: python3 ejemplos_python.py
"""

import requests
import json
from datetime import datetime
from typing import Dict, List, Optional

class ZodiacAPIClient:
    """Cliente para consumir la API Zodiac desde Python"""
    
    def __init__(self, base_url: str = 'http://192.168.0.9:8000'):
        self.base_url = base_url
        self.api_url = f'{base_url}/api'
        self.session = requests.Session()
        self.session.headers.update({'Content-Type': 'application/json'})
    
    def _make_request(self, method: str, endpoint: str, data: Optional[Dict] = None) -> Optional[Dict]:
        """Hacer request HTTP a la API"""
        url = f'{self.api_url}{endpoint}'
        
        try:
            if method == 'GET':
                response = self.session.get(url, timeout=5)
            elif method == 'POST':
                response = self.session.post(url, json=data, timeout=5)
            else:
                raise ValueError(f'Método HTTP no soportado: {method}')
            
            response.raise_for_status()
            return response.json()
        
        except requests.RequestException as e:
            print(f'❌ Error en request: {e}')
            return None
        except json.JSONDecodeError:
            print('❌ Error: Respuesta inválida del servidor')
            return None
    
    def get_all_signs(self) -> Optional[Dict]:
        """Obtener todos los signos zodiacales"""
        print('📡 Obteniendo todos los signos...')
        response = self._make_request('GET', '/zodiac/signs')
        if response and response.get('success'):
            print('✅ Signos obtenidos exitosamente')
        return response
    
    def get_zodiac_sign(self, birth_date: str) -> Optional[Dict]:
        """Obtener signo por fecha de nacimiento (formato: YYYY-MM-DD)"""
        print(f'📡 Buscando signo para fecha: {birth_date}')
        response = self._make_request('POST', '/zodiac', {'birth_date': birth_date})
        if response and response.get('success'):
            print(f"✅ Signo encontrado: {response['data']['zodiac_sign']}")
        return response
    
    def get_sign_by_name(self, sign_name: str) -> Optional[Dict]:
        """Obtener información de un signo específico"""
        print(f'📡 Obteniendo información de: {sign_name}')
        response = self._make_request('GET', f'/zodiac/signs/{sign_name}')
        if response and response.get('success'):
            print(f'✅ Información de {sign_name} obtenida')
        return response
    
    def get_compatibility(self, sign1: str, sign2: str) -> Optional[Dict]:
        """Verificar compatibilidad entre dos signos"""
        print(f'📡 Verificando compatibilidad: {sign1} - {sign2}')
        response = self._make_request('POST', '/zodiac/compatibility', 
                                     {'sign1': sign1, 'sign2': sign2})
        if response and response.get('success'):
            print('✅ Compatibilidad verificada')
        return response


def print_separator(title: str = ''):
    """Imprimir separador visual"""
    if title:
        print(f'\n{"━" * 70}')
        print(f'📊 {title}')
        print(f'{"━" * 70}')
    else:
        print(f'\n{"━" * 70}\n')


def print_signs_table(signs: List[Dict]):
    """Imprimir tabla de signos"""
    print('\n┌──────────────────────────────────────────────────────────────────┐')
    print('│                     SIGNOS ZODIACALES                            │')
    print('├──────────────────────────────────────────────────────────────────┤')
    print('│ # │    Signo    │ Símbolo │      Rango       │    Elemento     │')
    print('├──────────────────────────────────────────────────────────────────┤')
    
    for i, sign in enumerate(signs, 1):
        name = sign['name'].ljust(11)
        symbol = sign['symbol'].ljust(7)
        date_range = sign['date_range'].ljust(16)
        element = sign['element']
        print(f'│ {i:2} │ {name} │ {symbol} │ {date_range} │ {element:15} │')
    
    print('└──────────────────────────────────────────────────────────────────┘\n')


def print_zodiac_info(data: Dict):
    """Imprimir información de un signo"""
    print(f"\n📌 Información de {data['name']}:")
    print(f"   Nombre: {data['name']}")
    print(f"   Símbolo: {data['symbol']}")
    print(f"   Rango: {data['date_range']}")
    print(f"   Elemento: {data['element']}")
    print(f"   Descripción: {data['description']}")
    print(f"   Compatible con: {', '.join(data['compatible_signs'])}")


def main():
    """Función principal - ejecutar ejemplos"""
    
    print('\n🔮 EJEMPLOS DE USO - ZODIAC API CLIENT (Python)\n')
    
    # Crear cliente
    client = ZodiacAPIClient('http://192.168.0.9:8000')
    
    # ============ EJEMPLO 1 ============
    print_separator('EJEMPLO 1: Obtener todos los signos zodiacales')
    
    all_signs = client.get_all_signs()
    if all_signs and all_signs.get('success'):
        print_signs_table(all_signs['data']['signs'])
    
    
    # ============ EJEMPLO 2 ============
    print_separator('EJEMPLO 2: Obtener tu signo zodiacal por fecha')
    
    my_zodiac = client.get_zodiac_sign('1990-05-03')
    if my_zodiac and my_zodiac.get('success'):
        data = my_zodiac['data']
        print(f'\n📋 Tu Información Zodiacal:')
        print(f'   Signo: {data["zodiac_sign"]} {data["symbol"]}')
        print(f'   Rango: {data["date_range"]}')
        print(f'   Elemento: {data["element"]}')
        print(f'   Edad: {data["age"]} años')
        print(f'   Descripción: {data["description"]}')
        print(f'   Compatible con: {", ".join(data["compatible_signs"])}')
    
    
    # ============ EJEMPLO 3 ============
    print_separator('EJEMPLO 3: Obtener información detallada de un signo')
    
    tauro = client.get_sign_by_name('Tauro')
    if tauro and tauro.get('success'):
        print_zodiac_info(tauro['data'])
    
    
    # ============ EJEMPLO 4 ============
    print_separator('EJEMPLO 4: Verificar compatibilidad entre signos')
    
    compatibility = client.get_compatibility('Tauro', 'Virgo')
    if compatibility and compatibility.get('success'):
        compat = compatibility['data']
        print(f'\n💑 Compatibilidad Tauro - Virgo:')
        print(f'   {compat["compatibility_message"]}')
    
    
    # ============ EJEMPLO 5 ============
    print_separator('EJEMPLO 5: Búsqueda de múltiples fechas')
    
    print('\n🔍 Buscando signos para varias personas:\n')
    
    personas = [
        {'fecha': '1985-03-21', 'nombre': 'Juan'},
        {'fecha': '1992-07-15', 'nombre': 'María'},
        {'fecha': '1998-12-25', 'nombre': 'Carlos'},
        {'fecha': '2000-09-10', 'nombre': 'Ana'},
    ]
    
    for persona in personas:
        result = client.get_zodiac_sign(persona['fecha'])
        if result and result.get('success'):
            data = result['data']
            print(f'👤 {persona["nombre"]} ({persona["fecha"]})')
            print(f'   → {data["zodiac_sign"]} {data["symbol"]}')
            print(f'   → Elemento: {data["element"]}')
            print(f'   → Compatible con: {", ".join(data["compatible_signs"])}')
            print()
    
    
    # ============ RESUMEN ============
    print('━' * 70)
    print('✅ Ejemplos completados exitosamente')
    print('━' * 70 + '\n')


if __name__ == '__main__':
    try:
        main()
    except KeyboardInterrupt:
        print('\n\n⏹️  Ejecución interrumpida por el usuario')
    except Exception as e:
        print(f'\n❌ Error inesperado: {e}')
