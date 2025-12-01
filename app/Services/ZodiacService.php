<?php

namespace App\Services;

use DateTime;

class ZodiacService
{
    private array $zodiacSigns = [
        [
            'name' => 'Capricornio',
            'date_range' => '22 de diciembre - 19 de enero',
            'start_month' => 12,
            'start_day' => 22,
            'end_month' => 1,
            'end_day' => 19,
            'element' => 'Tierra',
            'symbol' => '♑',
            'description' => 'Capricornio es un signo de tierra conocido por su disciplina, responsabilidad y ambición. Los capricornianos son trabajadores incansables, prácticos y tienen un fuerte sentido del deber. Son conservadores pero también tienen un humor seco y una determinación inquebrantable. Valoran la estabilidad, la tradición y el logro de metas a largo plazo. Son personas confiables, honestas y leales con sus seres queridos.',
            'compatible_signs' => ['Tauro', 'Virgo', 'Escorpio', 'Piscis']
        ],
        [
            'name' => 'Acuario',
            'date_range' => '20 de enero - 18 de febrero',
            'start_month' => 1,
            'start_day' => 20,
            'end_month' => 2,
            'end_day' => 18,
            'element' => 'Aire',
            'symbol' => '♒',
            'description' => 'Acuario es un signo de aire caracterizado por su originalidad, independencia e innovación. Los acuarianos son visionarios que piensan de manera progresista y tienen ideas revolucionarias. Son humanitarios, amigables y les encanta ayudar a otros. Valoran la libertad personal y la individualidad. Son intelectuales, curiosos y siempre buscan nuevas perspectivas. A veces pueden ser impredecibles y distantes emocionalmente.',
            'compatible_signs' => ['Géminis', 'Libra', 'Sagitario', 'Aries']
        ],
        [
            'name' => 'Piscis',
            'date_range' => '19 de febrero - 20 de marzo',
            'start_month' => 2,
            'start_day' => 19,
            'end_month' => 3,
            'end_day' => 20,
            'element' => 'Agua',
            'symbol' => '♓',
            'description' => 'Piscis es un signo de agua conocido por su sensibilidad, intuición y compasión. Los piscianos son soñadores románticos con una conexión profunda con las emociones. Son artísticos, creativos y muy empáticos. Tienen una naturaleza mística y espiritual. Son flexibles, adaptables y siempre dispuestos a ayudar a otros. Aunque son fuertes emocionalmente, a veces pueden ser un poco escapistas y necesitan aprender a establecer límites.',
            'compatible_signs' => ['Cáncer', 'Escorpio', 'Capricornio', 'Tauro']
        ],
        [
            'name' => 'Aries',
            'date_range' => '21 de marzo - 19 de abril',
            'start_month' => 3,
            'start_day' => 21,
            'end_month' => 4,
            'end_day' => 19,
            'element' => 'Fuego',
            'symbol' => '♈',
            'description' => 'Aries es un signo de fuego conocido por su energía, valentía y pasión. Los arianos son líderes naturales, decididos y confiados. Son aventureros que adoran los desafíos y nuevas experiencias. Tienen un espíritu competitivo y siempre quieren estar primeros. Son impulsivos, entusiastas y muy directos. Aunque pueden ser agresivos a veces, su corazón es genuino. Son leales a aquellos que aman.',
            'compatible_signs' => ['León', 'Sagitario', 'Géminis', 'Acuario']
        ],
        [
            'name' => 'Tauro',
            'date_range' => '20 de abril - 20 de mayo',
            'start_month' => 4,
            'start_day' => 20,
            'end_month' => 5,
            'end_day' => 20,
            'element' => 'Tierra',
            'symbol' => '♉',
            'description' => 'Tauro es un signo de tierra caracterizado por su estabilidad, confiabilidad y sensibilidad. Los taurinos son personas prácticas con los pies en la tierra. Valoran la comodidad, la seguridad y las cosas bellas de la vida. Son pacientes, leales y muy persistentes en sus objetivos. Aunque pueden ser un poco obstinados, tienen un corazón enormemente generoso. Son amantes del arte, la música y la buena comida.',
            'compatible_signs' => ['Virgo', 'Capricornio', 'Cáncer', 'Piscis']
        ],
        [
            'name' => 'Géminis',
            'date_range' => '21 de mayo - 20 de junio',
            'start_month' => 5,
            'start_day' => 21,
            'end_month' => 6,
            'end_day' => 20,
            'element' => 'Aire',
            'symbol' => '♊',
            'description' => 'Géminis es un signo de aire conocido por su comunicación, versatilidad e inteligencia. Los geminianos son curiosos, ágiles mentalmente y excelentes comunicadores. Adoran aprender nuevas cosas y compartir información. Son adaptables, flexibles y les encanta la sociedad. Tienen un sentido del humor brillante y una mente juguetona. Aunque pueden ser un poco superficiales a veces, su capacidad de conectar con otros es excepcional.',
            'compatible_signs' => ['Libra', 'Acuario', 'Aries', 'León']
        ],
        [
            'name' => 'Cáncer',
            'date_range' => '21 de junio - 22 de julio',
            'start_month' => 6,
            'start_day' => 21,
            'end_month' => 7,
            'end_day' => 22,
            'element' => 'Agua',
            'symbol' => '♋',
            'description' => 'Cáncer es un signo de agua conocido por su sensibilidad, protección e intuición. Los cancerianos son profundamente emocionales y muy conectados con sus sentimientos. Son hogareños, familiares y valoran el hogar como su refugio seguro. Son nutrientes, compasivos y siempre están dispuestos a cuidar a otros. Tienen una memoria excelente y nunca olvidan un gesto amable o un acto de bondad. Son románticos y buscan relaciones profundas y significativas.',
            'compatible_signs' => ['Escorpio', 'Piscis', 'Tauro', 'Virgo']
        ],
        [
            'name' => 'León',
            'date_range' => '23 de julio - 22 de agosto',
            'start_month' => 7,
            'start_day' => 23,
            'end_month' => 8,
            'end_day' => 22,
            'element' => 'Fuego',
            'symbol' => '♌',
            'description' => 'León es un signo de fuego caracterizado por su confianza, generosidad y carisma. Los leoninos son naturalmente líderes, creativos y apasionados. Tienen un corazón grande y son muy generosos con quienes aman. Adoran estar en el centro de atención y brillar. Son orgullosos, leales y tienen un fuerte sentido de dignidad. Aunque pueden ser un poco arrogantes, su warmth y entusiasmo es contagioso. Son amigos verdaderos y protectores de quienes les importan.',
            'compatible_signs' => ['Sagitario', 'Aries', 'Libra', 'Géminis']
        ],
        [
            'name' => 'Virgo',
            'date_range' => '23 de agosto - 22 de septiembre',
            'start_month' => 8,
            'start_day' => 23,
            'end_month' => 9,
            'end_day' => 22,
            'element' => 'Tierra',
            'symbol' => '♍',
            'description' => 'Virgo es un signo de tierra conocido por su atención al detalle, servicio y perfección. Los virginianos son analíticos, meticulosos y muy organizados. Tienen una mente lógica y excelentes habilidades de resolución de problemas. Son modestos pero concienzudos en todo lo que hacen. Valoran la salud, la higiene y el bienestar. Aunque pueden ser críticos (especialmente consigo mismos), su dedicación al mejoramiento es admirable. Son confiables y siempre están listos para ayudar.',
            'compatible_signs' => ['Capricornio', 'Tauro', 'Escorpio', 'Cáncer']
        ],
        [
            'name' => 'Libra',
            'date_range' => '23 de septiembre - 22 de octubre',
            'start_month' => 9,
            'start_day' => 23,
            'end_month' => 10,
            'end_day' => 22,
            'element' => 'Aire',
            'symbol' => '♎',
            'description' => 'Libra es un signo de aire caracterizado por su búsqueda de equilibrio, justicia y armonía. Los libranos son diplomáticos, justos y tienen un sentido innato de lo que es correcto. Son sociables, encantadores y excelentes en las relaciones públicas. Valoran la belleza, el arte y la estética. Son indecisivos a veces porque siempre ven ambos lados de una situación. Aunque pueden parecer superficiales, en realidad son profundamente inteligentes y considerados. Son amigos leales y buscan relaciones equilibradas.',
            'compatible_signs' => ['Acuario', 'Géminis', 'León', 'Sagitario']
        ],
        [
            'name' => 'Escorpio',
            'date_range' => '23 de octubre - 21 de noviembre',
            'start_month' => 10,
            'start_day' => 23,
            'end_month' => 11,
            'end_day' => 21,
            'element' => 'Agua',
            'symbol' => '♏',
            'description' => 'Escorpio es un signo de agua caracterizado por su intensidad, misterio y transformación. Los escorpianos son profundos, emocionales y extremadamente perceptivos. Tienen un poder magnético y una presencia intimidante. Son apasionados, leales y nunca hacen nada a medias. Tienen una capacidad innata para comprender los secretos y la psicología humana. Aunque pueden ser vengativo a veces, su fidelidad y protección hacia quienes aman es incondicional. Son los más transformadores del zodiaco.',
            'compatible_signs' => ['Piscis', 'Cáncer', 'Virgo', 'Capricornio']
        ],
        [
            'name' => 'Sagitario',
            'date_range' => '22 de noviembre - 21 de diciembre',
            'start_month' => 11,
            'start_day' => 22,
            'end_month' => 12,
            'end_day' => 21,
            'element' => 'Fuego',
            'symbol' => '♐',
            'description' => 'Sagitario es un signo de fuego conocido por su optimismo, aventura y sabiduría. Los sagitarianos son viajeros natos con un espíritu explorador. Son filósofos, amantes del aprendizaje y siempre buscan la verdad. Tienen un sentido del humor excelente y aman la libertad. Son honestos, a veces demasiado directos, pero siempre auténticos. Valoran la independencia y no soportan las restricciones. Son amigos sinceros y compañeros de aventura entusiastas. Su entusiasmo es contagioso.',
            'compatible_signs' => ['Aries', 'León', 'Libra', 'Acuario']
        ]
    ];

    /**
     * Obtiene el signo zodiacal basado en una fecha de nacimiento
     *
     * @param string $birthDate Fecha de nacimiento en formato 'YYYY-MM-DD' o 'DD-MM-YYYY'
     * @return array Información completa del signo zodiacal
     * @throws \Exception
     */
    public function getZodiacSign(string $birthDate): array
    {
        try {
            // Parsear la fecha
            $date = $this->parseDate($birthDate);
            $month = (int)$date->format('m');
            $day = (int)$date->format('d');

            // Encontrar el signo correspondiente
            $zodiacSign = $this->findZodiacSign($month, $day);

            if (!$zodiacSign) {
                throw new \Exception('No se pudo determinar el signo zodiacal para la fecha proporcionada.');
            }

            // Calcular edad
            $age = $this->calculateAge($date);

            return [
                'success' => true,
                'birth_date' => $date->format('Y-m-d'),
                'age' => $age,
                'zodiac_sign' => $zodiacSign['name'],
                'symbol' => $zodiacSign['symbol'],
                'date_range' => $zodiacSign['date_range'],
                'element' => $zodiacSign['element'],
                'description' => $zodiacSign['description'],
                'compatible_signs' => $zodiacSign['compatible_signs'],
                'message' => "¡Hola! Eres del signo zodiacal {$zodiacSign['name']}. {$zodiacSign['symbol']}"
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Parsea una fecha en diferentes formatos
     *
     * @param string $dateString Cadena de fecha
     * @return DateTime
     * @throws \Exception
     */
    private function parseDate(string $dateString): DateTime
    {
        $dateString = trim($dateString);

        // Intentar diferentes formatos
        $formats = [
            'Y-m-d',
            'd-m-Y',
            'd/m/Y',
            'Y/m/d',
            'd.m.Y',
            'Y.m.d'
        ];

        foreach ($formats as $format) {
            $date = DateTime::createFromFormat($format, $dateString);
            if ($date !== false) {
                return $date;
            }
        }

        throw new \Exception("Formato de fecha no válido. Use: YYYY-MM-DD o DD-MM-YYYY");
    }

    /**
     * Encuentra el signo zodiacal para un mes y día específicos
     *
     * @param int $month Mes (1-12)
     * @param int $day Día (1-31)
     * @return array|null Información del signo zodiacal
     */
    private function findZodiacSign(int $month, int $day): ?array
    {
        foreach ($this->zodiacSigns as $sign) {
            if ($this->dateInRange($month, $day, $sign)) {
                return $sign;
            }
        }

        return null;
    }

    /**
     * Verifica si una fecha está dentro del rango de un signo zodiacal
     *
     * @param int $month Mes
     * @param int $day Día
     * @param array $sign Información del signo
     * @return bool
     */
    private function dateInRange(int $month, int $day, array $sign): bool
    {
        $startMonth = $sign['start_month'];
        $startDay = $sign['start_day'];
        $endMonth = $sign['end_month'];
        $endDay = $sign['end_day'];

        // Si el signo no cruza el año (ej. Mayo)
        if ($startMonth < $endMonth) {
            if ($month > $startMonth && $month < $endMonth) {
                return true;
            }
            if ($month === $startMonth && $day >= $startDay) {
                return true;
            }
            if ($month === $endMonth && $day <= $endDay) {
                return true;
            }
        }
        // Si el signo cruza el año (ej. Capricornio)
        else {
            if ($month > $startMonth || ($month === $startMonth && $day >= $startDay)) {
                return true;
            }
            if ($month < $endMonth || ($month === $endMonth && $day <= $endDay)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Calcula la edad basada en la fecha de nacimiento
     *
     * @param DateTime $birthDate Fecha de nacimiento
     * @return int Edad en años
     */
    private function calculateAge(DateTime $birthDate): int
    {
        $today = new DateTime();
        $age = $today->diff($birthDate)->y;
        return $age;
    }

    /**
     * Obtiene todos los signos zodiacales
     *
     * @return array Lista de todos los signos zodiacales
     */
    public function getAllZodiacSigns(): array
    {
        return array_map(function ($sign) {
            return [
                'name' => $sign['name'],
                'date_range' => $sign['date_range'],
                'symbol' => $sign['symbol'],
                'element' => $sign['element'],
                'description' => $sign['description'],
                'compatible_signs' => $sign['compatible_signs']
            ];
        }, $this->zodiacSigns);
    }

    /**
     * Obtiene la compatibilidad entre dos signos zodiacales
     *
     * @param string $sign1 Primer signo zodiacal
     * @param string $sign2 Segundo signo zodiacal
     * @return array Información de compatibilidad
     */
    public function getCompatibility(string $sign1, string $sign2): array
    {
        $sign1 = ucfirst(mb_strtolower($sign1));
        $sign2 = ucfirst(mb_strtolower($sign2));

        if ($sign1 === $sign2) {
            return [
                'success' => true,
                'compatibility' => 'Excelente - Mismo signo zodiacal',
                'percentage' => 100,
                'message' => "Dos $sign1 generalmente tienen una compatibilidad excelente debido a que comparten características similares."
            ];
        }

        $sign1Data = $this->findSignByName($sign1);
        $sign2Data = $this->findSignByName($sign2);

        if (!$sign1Data || !$sign2Data) {
            return [
                'success' => false,
                'error' => 'Uno o ambos signos zodiacales no son válidos.'
            ];
        }

        $isCompatible = in_array($sign2, $sign1Data['compatible_signs']);
        $percentage = $isCompatible ? 85 : 45;

        return [
            'success' => true,
            'sign1' => $sign1,
            'sign2' => $sign2,
            'compatibility' => $isCompatible ? 'Compatible' : 'No muy compatible',
            'percentage' => $percentage,
            'message' => $isCompatible 
                ? "$sign1 y $sign2 son signos compatibles. Comparten elementos o características que permiten una buena armonía."
                : "$sign1 y $sign2 no son los más compatibles, pero pueden funcionar con comprensión mutua."
        ];
    }

    /**
     * Encuentra un signo zodiacal por su nombre
     *
     * @param string $name Nombre del signo
     * @return array|null
     */
    private function findSignByName(string $name): ?array
    {
        foreach ($this->zodiacSigns as $sign) {
            if (mb_strtolower($sign['name']) === mb_strtolower($name)) {
                return $sign;
            }
        }

        return null;
    }
}
