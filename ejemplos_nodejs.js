/**
 * Ejemplos de uso del cliente ZodiacAPIClient en Node.js
 * 
 * Ejecución: node ejemplos.js
 */

const ZodiacAPIClient = require('./ZodiacAPIClient');

// Crear instancia del cliente
const zodiacClient = new ZodiacAPIClient('http://192.168.0.9:8000');

// Función para imprimir resultados formateados
function printResult(title, data) {
    console.log('\n' + '='.repeat(60));
    console.log(`📊 ${title}`);
    console.log('='.repeat(60));
    console.log(JSON.stringify(data, null, 2));
    console.log('='.repeat(60));
}

// Función para crear tabla de signos
function printSignsTable(signs) {
    console.log('\n┌─────────────────────────────────────────────────────────┐');
    console.log('│                   SIGNOS ZODIACALES                      │');
    console.log('├─────────────────────────────────────────────────────────┤');
    console.log('│ # │  Signo      │ Símbolo │    Rango      │  Elemento   │');
    console.log('├─────────────────────────────────────────────────────────┤');
    
    signs.forEach((sign, index) => {
        const num = String(index + 1).padEnd(2);
        const name = sign.name.padEnd(11);
        const symbol = sign.symbol.padEnd(7);
        const range = sign.date_range.padEnd(13);
        const element = sign.element;
        console.log(`│ ${num} │ ${name} │ ${symbol} │ ${range} │ ${element} │`);
    });
    
    console.log('└─────────────────────────────────────────────────────────┘\n');
}

// Función para ejecutar ejemplos secuencialmente
async function runExamples() {
    console.log('\n🔮 EJEMPLOS DE USO - ZODIAC API CLIENT (Node.js)\n');
    
    // EJEMPLO 1: Obtener todos los signos
    console.log('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
    console.log('EJEMPLO 1: Obtener todos los signos zodiacales');
    console.log('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
    
    const allSigns = await zodiacClient.getAllSigns();
    if (allSigns && allSigns.success) {
        printSignsTable(allSigns.data.signs);
    }
    
    // EJEMPLO 2: Obtener signo personal por fecha
    console.log('\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
    console.log('EJEMPLO 2: Obtener tu signo zodiacal por fecha de nacimiento');
    console.log('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
    
    const myZodiac = await zodiacClient.getZodiacSign('1990-05-03');
    if (myZodiac && myZodiac.success) {
        const data = myZodiac.data;
        console.log('\n📋 Tu Información Zodiacal:');
        console.log(`   Signo: ${data.zodiac_sign} ${data.symbol}`);
        console.log(`   Rango: ${data.date_range}`);
        console.log(`   Elemento: ${data.element}`);
        console.log(`   Edad: ${data.age} años`);
        console.log(`   Descripción: ${data.description}`);
        console.log(`   Compatible con: ${data.compatible_signs.join(', ')}`);
    }
    
    // EJEMPLO 3: Obtener información de un signo específico
    console.log('\n\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
    console.log('EJEMPLO 3: Obtener información detallada de un signo');
    console.log('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
    
    const tauro = await zodiacClient.getSignByName('Tauro');
    if (tauro && tauro.success) {
        const sign = tauro.data;
        console.log('\n📌 Información de Tauro:');
        console.log(`   Nombre: ${sign.name}`);
        console.log(`   Símbolo: ${sign.symbol}`);
        console.log(`   Rango: ${sign.date_range}`);
        console.log(`   Elemento: ${sign.element}`);
        console.log(`   Descripción: ${sign.description}`);
        console.log(`   Compatible con: ${sign.compatible_signs.join(', ')}`);
    }
    
    // EJEMPLO 4: Verificar compatibilidad
    console.log('\n\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
    console.log('EJEMPLO 4: Verificar compatibilidad entre signos');
    console.log('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
    
    const compatibility = await zodiacClient.getCompatibility('Tauro', 'Virgo');
    if (compatibility && compatibility.success) {
        const compat = compatibility.data;
        console.log('\n💑 Compatibilidad Tauro - Virgo:');
        console.log(`   ${compat.compatibility_message}`);
    }
    
    // EJEMPLO 5: Búsqueda interactiva simulada
    console.log('\n\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
    console.log('EJEMPLO 5: Búsqueda de múltiples fechas (simulación)');
    console.log('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
    
    const fechas = [
        { fecha: '1985-03-21', nombre: 'Juan' },
        { fecha: '1992-07-15', nombre: 'María' },
        { fecha: '1998-12-25', nombre: 'Carlos' }
    ];
    
    console.log('\n🔍 Buscando signos para varias personas:\n');
    
    for (const persona of fechas) {
        const result = await zodiacClient.getZodiacSign(persona.fecha);
        if (result && result.success) {
            console.log(`👤 ${persona.nombre} (${persona.fecha})`);
            console.log(`   → ${result.data.zodiac_sign} ${result.data.symbol}`);
            console.log(`   → Compatible con: ${result.data.compatible_signs.join(', ')}\n`);
        }
    }
    
    // RESUMEN FINAL
    console.log('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
    console.log('✅ Ejemplos completados exitosamente');
    console.log('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n');
}

// Ejecutar ejemplos
runExamples().catch(error => {
    console.error('❌ Error durante la ejecución:', error);
});
