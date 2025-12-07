/**
 * ZodiacAPIClient - Cliente para Node.js
 * Consumir la API Zodiac desde tu servidor Node.js
 */

const https = require('https');
const http = require('http');
const querystring = require('querystring');

class ZodiacAPIClient {
    constructor(baseUrl = 'http://192.168.0.9:8000') {
        this.baseUrl = baseUrl;
        this.apiUrl = `${baseUrl}/api`;
    }

    /**
     * Hacer request HTTP/HTTPS
     */
    request(method, path, data = null) {
        return new Promise((resolve, reject) => {
            const url = new URL(this.apiUrl + path);
            const isHttps = url.protocol === 'https:';
            const client = isHttps ? https : http;

            const options = {
                hostname: url.hostname,
                port: url.port,
                path: url.pathname + url.search,
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'User-Agent': 'ZodiacAPIClient/1.0'
                }
            };

            const req = client.request(options, (res) => {
                let body = '';

                res.on('data', (chunk) => {
                    body += chunk;
                });

                res.on('end', () => {
                    try {
                        const json = JSON.parse(body);
                        resolve(json);
                    } catch (e) {
                        reject(new Error('Invalid JSON response'));
                    }
                });
            });

            req.on('error', reject);

            if (data) {
                req.write(JSON.stringify(data));
            }

            req.end();
        });
    }

    /**
     * Obtener todos los signos zodiacales
     */
    async getAllSigns() {
        try {
            console.log('📡 Obteniendo todos los signos...');
            const response = await this.request('GET', '/zodiac/signs');
            console.log('✅ Signos obtenidos exitosamente');
            return response;
        } catch (error) {
            console.error('❌ Error al obtener signos:', error.message);
            return null;
        }
    }

    /**
     * Obtener signo zodiacal por fecha de nacimiento
     */
    async getZodiacSign(birthDate) {
        try {
            console.log(`📡 Buscando signo para fecha: ${birthDate}`);
            const response = await this.request('POST', '/zodiac', {
                birth_date: birthDate
            });
            if (response.success) {
                console.log(`✅ Signo encontrado: ${response.data.zodiac_sign}`);
            }
            return response;
        } catch (error) {
            console.error('❌ Error al obtener signo:', error.message);
            return null;
        }
    }

    /**
     * Obtener información de un signo específico por nombre
     */
    async getSignByName(signName) {
        try {
            console.log(`📡 Obteniendo información de: ${signName}`);
            const response = await this.request('GET', `/zodiac/signs/${signName}`);
            if (response.success) {
                console.log(`✅ Información de ${signName} obtenida`);
            }
            return response;
        } catch (error) {
            console.error('❌ Error al obtener signo:', error.message);
            return null;
        }
    }

    /**
     * Verificar compatibilidad entre dos signos
     */
    async getCompatibility(sign1, sign2) {
        try {
            console.log(`📡 Verificando compatibilidad: ${sign1} - ${sign2}`);
            const response = await this.request('POST', '/zodiac/compatibility', {
                sign1: sign1,
                sign2: sign2
            });
            if (response.success) {
                console.log('✅ Compatibilidad verificada');
            }
            return response;
        } catch (error) {
            console.error('❌ Error al verificar compatibilidad:', error.message);
            return null;
        }
    }
}

module.exports = ZodiacAPIClient;
