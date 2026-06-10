<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarHire;
use App\Models\Transfer;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use SeerbitLaravel\Facades\Seerbit;

class CarController extends Controller
{
    public function index()
    {
        $categories = [

            /* ====================================================================
            * SALOON
            * Regular   = older reliable models (Corolla, Sunny, Accent, Yaris)
            * Standard  = mid-age popular models (Camry, Accord, Elantra, Optima)
            * Executive = new premium models (Avalon, Camry XSE, Accord Sport, K5)
            * ==================================================================== */
            'saloon' => [
                'fuel_rate_per_km' => 1300,
                'hourly_rate'      => 5000,
                'items' => [
                    [
                        'name'       => 'Regular',
                        'price'      => 15000,
                        'passengers' => '1 – 3 Passengers',
                        'images'     => [
                            asset('assets/image/saloon.jpg'),
                            asset('assets/image/saloon.jpg'),
                            asset('assets/image/saloon.jpg'),
                        ],
                        'models' => [
                            [
                                'name'  => 'Toyota Corolla',
                                'image' => asset('assets/image/saloon.jpg'),
                                'features' => [
                                    'Reliable and fuel-efficient sedan',
                                    'Air conditioning',
                                    'Professional driver',
                                    'Comfortable rear seating',
                                    'Adequate boot space',
                                ],
                            ],
                            [
                                'name'  => 'Nissan Sunny',
                                'image' => asset('assets/image/saloon.jpg'),
                                'features' => [
                                    'Spacious interior for a compact car',
                                    'Air conditioning',
                                    'Professional driver',
                                    'Smooth city ride',
                                    'Basic luggage space',
                                ],
                            ],
                            [
                                'name'  => 'Hyundai Accent',
                                'image' => asset('assets/image/saloon.jpg'),
                                'features' => [
                                    'Compact and agile city sedan',
                                    'Air conditioning',
                                    'Professional driver',
                                    'Easy navigation in traffic',
                                    'Decent boot capacity',
                                ],
                            ],
                            [
                                'name'  => 'Toyota Yaris',
                                'image' => asset('assets/image/saloon.jpg'),
                                'features' => [
                                    'Nimble city car',
                                    'Air conditioning',
                                    'Professional driver',
                                    'Low fuel consumption',
                                    'Ideal for short airport runs',
                                ],
                            ],
                        ],
                    ],
                    [
                        'name'       => 'Standard',
                        'price'      => 20000,
                        'passengers' => '1 – 3 Passengers',
                        'images'     => [
                            asset('assets/image/saloon.jpg'),
                            asset('assets/image/saloon.jpg'),
                            asset('assets/image/saloon.jpg'),
                        ],
                        'models' => [
                            [
                                'name'  => 'Toyota Camry',
                                'image' => asset('assets/image/saloon.jpg'),
                                'features' => [
                                    'Smooth and comfortable mid-size sedan',
                                    'Full air conditioning',
                                    'Professional uniformed driver',
                                    'Leather-trimmed interior',
                                    'Complimentary bottled water',
                                    'Spacious boot for luggage',
                                ],
                            ],
                            [
                                'name'  => 'Honda Accord',
                                'image' => asset('assets/image/saloon.jpg'),
                                'features' => [
                                    'Sporty yet refined mid-size sedan',
                                    'Full air conditioning',
                                    'Professional uniformed driver',
                                    'Premium dashboard finish',
                                    'Complimentary bottled water',
                                    'Wide rear legroom',
                                ],
                            ],
                            [
                                'name'  => 'Hyundai Elantra',
                                'image' => asset('assets/image/saloon.jpg'),
                                'features' => [
                                    'Modern compact sedan with bold design',
                                    'Full air conditioning',
                                    'Professional uniformed driver',
                                    'Advanced infotainment system',
                                    'Complimentary bottled water',
                                    'Comfortable suspension',
                                ],
                            ],
                            [
                                'name'  => 'Kia Optima',
                                'image' => asset('assets/image/saloon.jpg'),
                                'features' => [
                                    'Stylish and spacious mid-size sedan',
                                    'Full air conditioning',
                                    'Professional uniformed driver',
                                    'Panoramic sunroof option',
                                    'Complimentary bottled water',
                                    'Generous legroom',
                                ],
                            ],
                        ],
                    ],
                    [
                        'name'       => 'Executive',
                        'price'      => 30000,
                        'passengers' => '1 – 3 Passengers',
                        'images'     => [
                            asset('assets/image/saloon.jpg'),
                            asset('assets/image/saloon.jpg'),
                            asset('assets/image/saloon.jpg'),
                        ],
                        'models' => [
                            [
                                'name'  => 'Toyota Avalon',
                                'image' => asset('assets/image/saloon.jpg'),
                                'features' => [
                                    'Full-size premium executive sedan',
                                    'Dual-zone climate control',
                                    'Smartly dressed chauffeur',
                                    'JBL premium sound system',
                                    'Complimentary refreshments',
                                    'Meet & greet service',
                                    'Large boot for luggage',
                                ],
                            ],
                            [
                                'name'  => 'Toyota Camry XSE',
                                'image' => asset('assets/image/saloon.jpg'),
                                'features' => [
                                    'Sport-tuned executive saloon',
                                    'Dual-zone climate control',
                                    'Smartly dressed chauffeur',
                                    'Panoramic moonroof',
                                    'Complimentary refreshments',
                                    'Wi-Fi on request',
                                    'Meet & greet service',
                                ],
                            ],
                            [
                                'name'  => 'Honda Accord Sport',
                                'image' => asset('assets/image/saloon.jpg'),
                                'features' => [
                                    'Performance-grade executive sedan',
                                    'Dual-zone climate control',
                                    'Smartly dressed chauffeur',
                                    'Turbocharged smooth ride',
                                    'Complimentary refreshments',
                                    'Large boot for luggage',
                                    'Meet & greet service',
                                ],
                            ],
                            [
                                'name'  => 'Kia K5 GT',
                                'image' => asset('assets/image/saloon.jpg'),
                                'features' => [
                                    'Premium sport executive sedan',
                                    'Dual-zone climate control',
                                    'Smartly dressed chauffeur',
                                    'Bose premium audio',
                                    'Complimentary refreshments',
                                    'Wi-Fi on request',
                                    'Meet & greet service',
                                ],
                            ],
                        ],
                    ],
                ],
            ],

            /* ====================================================================
            * SUV
            * Regular   = older workhorse SUVs (CR-V, RAV4, Tucson, X-Trail)
            * Standard  = current gen family SUVs (Highlander, Pilot, Pathfinder, Explorer)
            * Executive = premium full-size SUVs (Prado, RX 350, GLE, X5)
            * ==================================================================== */
            'suv' => [
                'fuel_rate_per_km' => 1300,
                'hourly_rate'      => 8000,
                'items' => [
                    [
                        'name'       => 'Regular',
                        'price'      => 30000,
                        'passengers' => '1 – 3 Passengers',
                        'images'     => [
                            asset('assets/image/suv.jpg'),
                            asset('assets/image/suv.jpg'),
                            asset('assets/image/suv.jpg'),
                        ],
                        'models' => [
                            [
                                'name'  => 'Honda CR-V',
                                'image' => asset('assets/image/suv.jpg'),
                                'features' => [
                                    'Compact crossover SUV',
                                    'Air conditioning',
                                    'Professional driver',
                                    'Raised seating position',
                                    'Good luggage capacity',
                                    'Smooth highway ride',
                                ],
                            ],
                            [
                                'name'  => 'Toyota RAV4',
                                'image' => asset('assets/image/suv.jpg'),
                                'features' => [
                                    'Popular and reliable compact SUV',
                                    'Air conditioning',
                                    'Professional driver',
                                    'Comfortable all-road ride',
                                    'Spacious rear cabin',
                                    'Good boot capacity',
                                ],
                            ],
                            [
                                'name'  => 'Hyundai Tucson',
                                'image' => asset('assets/image/suv.jpg'),
                                'features' => [
                                    'Modern compact crossover',
                                    'Air conditioning',
                                    'Professional driver',
                                    'Contemporary interior design',
                                    'Comfortable for city & highway',
                                    'Adequate luggage space',
                                ],
                            ],
                            [
                                'name'  => 'Nissan X-Trail',
                                'image' => asset('assets/image/suv.jpg'),
                                'features' => [
                                    'Versatile family SUV',
                                    'Air conditioning',
                                    'Professional driver',
                                    'Flexible seating arrangement',
                                    'Smooth ride quality',
                                    'Large boot space',
                                ],
                            ],
                        ],
                    ],
                    [
                        'name'       => 'Standard',
                        'price'      => 40000,
                        'passengers' => '1 – 3 Passengers',
                        'images'     => [
                            asset('assets/image/suv.jpg'),
                            asset('assets/image/suv.jpg'),
                            asset('assets/image/suv.jpg'),
                        ],
                        'models' => [
                            [
                                'name'  => 'Toyota Highlander',
                                'image' => asset('assets/image/suv.jpg'),
                                'features' => [
                                    'Full-size 3-row family SUV',
                                    'Full air conditioning',
                                    'Professional uniformed driver',
                                    'Spacious third-row seating',
                                    'Complimentary bottled water',
                                    'Large boot for luggage',
                                ],
                            ],
                            [
                                'name'  => 'Honda Pilot',
                                'image' => asset('assets/image/suv.jpg'),
                                'features' => [
                                    'Large family-friendly SUV',
                                    'Full air conditioning',
                                    'Professional uniformed driver',
                                    'Wide cabin with 3 rows',
                                    'Complimentary bottled water',
                                    'Entertainment screen option',
                                ],
                            ],
                            [
                                'name'  => 'Nissan Pathfinder',
                                'image' => asset('assets/image/suv.jpg'),
                                'features' => [
                                    'Rugged yet comfortable mid-size SUV',
                                    'Full air conditioning',
                                    'Professional uniformed driver',
                                    'Tri-zone climate control',
                                    'Complimentary bottled water',
                                    'Excellent road presence',
                                ],
                            ],
                            [
                                'name'  => 'Ford Explorer',
                                'image' => asset('assets/image/suv.jpg'),
                                'features' => [
                                    'American full-size SUV',
                                    'Full air conditioning',
                                    'Professional uniformed driver',
                                    'Panoramic sunroof',
                                    'Complimentary bottled water',
                                    'Spacious 3-row interior',
                                ],
                            ],
                        ],
                    ],
                    [
                        'name'       => 'Executive',
                        'price'      => 60000,
                        'passengers' => '1 – 3 Passengers',
                        'images'     => [
                            asset('assets/image/suv.jpg'),
                            asset('assets/image/suv.jpg'),
                            asset('assets/image/suv.jpg'),
                        ],
                        'models' => [
                            [
                                'name'  => 'Toyota Land Cruiser Prado',
                                'image' => asset('assets/image/suv.jpg'),
                                'features' => [
                                    'Iconic premium off-road SUV',
                                    'Dual-zone climate control',
                                    'Smartly dressed chauffeur',
                                    'Terrain management system',
                                    'Complimentary refreshments',
                                    'Meet & greet service',
                                    'Extra-large boot space',
                                ],
                            ],
                            [
                                'name'  => 'Lexus RX 350',
                                'image' => asset('assets/image/suv.jpg'),
                                'features' => [
                                    'Luxury crossover SUV',
                                    'Dual-zone climate control',
                                    'Smartly dressed chauffeur',
                                    'Mark Levinson sound system',
                                    'Complimentary refreshments',
                                    'Panoramic sunroof',
                                    'Meet & greet service',
                                ],
                            ],
                            [
                                'name'  => 'Mercedes GLE',
                                'image' => asset('assets/image/suv.jpg'),
                                'features' => [
                                    'European premium full-size SUV',
                                    'Dual-zone climate control',
                                    'Smartly dressed chauffeur',
                                    'Burmester surround sound',
                                    'Complimentary refreshments',
                                    'Wi-Fi on request',
                                    'Meet & greet service',
                                ],
                            ],
                            [
                                'name'  => 'BMW X5',
                                'image' => asset('assets/image/suv.jpg'),
                                'features' => [
                                    'Sports Activity Vehicle — pure luxury',
                                    'Dual-zone climate control',
                                    'Smartly dressed chauffeur',
                                    'Harman Kardon audio system',
                                    'Complimentary refreshments',
                                    'Panoramic roof',
                                    'Meet & greet service',
                                ],
                            ],
                        ],
                    ],
                ],
            ],

            /* ====================================================================
            * MINI VAN
            * Regular   = older high-roof vans (HiAce old, Previa, H1)
            * Standard  = current people-carriers (HiAce new, Sienna, Carnival)
            * Executive = premium vans (Vito, V-Class, Staria)
            * ==================================================================== */
            'van' => [
                'fuel_rate_per_km' => 1300,
                'hourly_rate'      => 10000,
                'items' => [
                    [
                        'name'       => 'Regular',
                        'price'      => 40000,
                        'passengers' => 'Up to 5 Passengers',
                        'images'     => [
                            asset('assets/image/minivan.png'),
                            asset('assets/image/minivan.png'),
                            asset('assets/image/minivan.png'),
                        ],
                        'models' => [
                            [
                                'name'  => 'Toyota HiAce (Old)',
                                'image' => asset('assets/image/minivan.png'),
                                'features' => [
                                    'High-roof passenger van',
                                    'Air conditioning',
                                    'Professional driver',
                                    'Group-friendly bench seating',
                                    'Large luggage compartment',
                                    'Reliable for inter-city runs',
                                ],
                            ],
                            [
                                'name'  => 'Toyota Previa',
                                'image' => asset('assets/image/minivan.png'),
                                'features' => [
                                    'Spacious mid-size people carrier',
                                    'Air conditioning',
                                    'Professional driver',
                                    'Sliding rear doors',
                                    'Comfortable for families',
                                    'Good luggage space',
                                ],
                            ],
                            [
                                'name'  => 'Hyundai H1',
                                'image' => asset('assets/image/minivan.png'),
                                'features' => [
                                    'Compact high-roof van',
                                    'Air conditioning',
                                    'Professional driver',
                                    'Adjustable rear seating',
                                    'Easy entry & exit',
                                    'Adequate boot storage',
                                ],
                            ],
                        ],
                    ],
                    [
                        'name'       => 'Standard',
                        'price'      => 55000,
                        'passengers' => 'Up to 5 Passengers',
                        'images'     => [
                            asset('assets/image/minivan.png'),
                            asset('assets/image/minivan.png'),
                            asset('assets/image/minivan.png'),
                        ],
                        'models' => [
                            [
                                'name'  => 'Toyota HiAce',
                                'image' => asset('assets/image/minivan.png'),
                                'features' => [
                                    'Current generation people mover',
                                    'Full air conditioning',
                                    'Professional uniformed driver',
                                    'Wide sliding doors for easy boarding',
                                    'Complimentary bottled water',
                                    'Generous luggage bay',
                                ],
                            ],
                            [
                                'name'  => 'Toyota Sienna',
                                'image' => asset('assets/image/minivan.png'),
                                'features' => [
                                    'American premium minivan',
                                    'Full air conditioning',
                                    'Professional uniformed driver',
                                    'Power sliding rear doors',
                                    'Complimentary bottled water',
                                    'Fold-flat rear seats',
                                ],
                            ],
                            [
                                'name'  => 'Kia Carnival',
                                'image' => asset('assets/image/minivan.png'),
                                'features' => [
                                    'Modern premium people carrier',
                                    'Full air conditioning',
                                    'Professional uniformed driver',
                                    'Panoramic sunroof',
                                    'Complimentary bottled water',
                                    'Captain rear seats',
                                ],
                            ],
                        ],
                    ],
                    [
                        'name'       => 'Executive',
                        'price'      => 75000,
                        'passengers' => 'Up to 5 Passengers',
                        'images'     => [
                            asset('assets/image/minivan.png'),
                            asset('assets/image/minivan.png'),
                            asset('assets/image/minivan.png'),
                        ],
                        'models' => [
                            [
                                'name'  => 'Mercedes Vito',
                                'image' => asset('assets/image/minivan.png'),
                                'features' => [
                                    'Premium executive van',
                                    'Full climate control',
                                    'Smartly dressed chauffeur',
                                    'Individual reclining captain seats',
                                    'Complimentary refreshments',
                                    'USB charging at every seat',
                                    'Wi-Fi on request',
                                ],
                            ],
                            [
                                'name'  => 'Mercedes V-Class',
                                'image' => asset('assets/image/minivan.png'),
                                'features' => [
                                    'Top-tier luxury people carrier',
                                    'Full climate control',
                                    'Smartly dressed chauffeur',
                                    'Conference-style seating option',
                                    'Complimentary refreshments',
                                    'Panoramic roof',
                                    'Wi-Fi & premium sound system',
                                ],
                            ],
                            [
                                'name'  => 'Hyundai Staria',
                                'image' => asset('assets/image/minivan.png'),
                                'features' => [
                                    'Futuristic premium people mover',
                                    'Full climate control',
                                    'Smartly dressed chauffeur',
                                    'Swivel captain seats',
                                    'Complimentary refreshments',
                                    'Ambient interior lighting',
                                    'Large panoramic windows',
                                ],
                            ],
                        ],
                    ],
                ],
            ],

            /* ====================================================================
            * BUS
            * Regular   = older coaster buses
            * Standard  = mid-age coaster / Sprinter / Transit
            * Executive = new luxury coach
            * ==================================================================== */
            'bus' => [
                'fuel_rate_per_km' => 1300,
                'hourly_rate'      => 15000,
                'items' => [
                    [
                        'name'       => 'Regular',
                        'price'      => 40000,
                        'passengers' => 'Up to 12 Passengers',
                        'images'     => [
                            asset('assets/image/coaster.jpg'),
                            asset('assets/image/coaster.jpg'),
                            asset('assets/image/coaster.jpg'),
                        ],
                        'models' => [
                            [
                                'name'  => 'Toyota Coaster (Old)',
                                'image' => asset('assets/image/coaster.jpg'),
                                'features' => [
                                    'Classic coaster bus',
                                    'Air conditioning',
                                    'Professional driver',
                                    'Row seating for large groups',
                                    'Overhead luggage racks',
                                    'Reliable for group transfers',
                                ],
                            ],
                            [
                                'name'  => 'Mitsubishi Rosa',
                                'image' => asset('assets/image/coaster.jpg'),
                                'features' => [
                                    'Compact group transport bus',
                                    'Air conditioning',
                                    'Professional driver',
                                    'Comfortable padded seating',
                                    'Luggage compartment below',
                                    'Easy boarding steps',
                                ],
                            ],
                        ],
                    ],
                    [
                        'name'       => 'Standard',
                        'price'      => 55000,
                        'passengers' => 'Up to 12 Passengers',
                        'images'     => [
                            asset('assets/image/coaster.jpg'),
                            asset('assets/image/coaster.jpg'),
                            asset('assets/image/coaster.jpg'),
                        ],
                        'models' => [
                            [
                                'name'  => 'Toyota Coaster',
                                'image' => asset('assets/image/coaster.jpg'),
                                'features' => [
                                    'Current generation coaster bus',
                                    'Full air conditioning',
                                    'Professional uniformed driver',
                                    'Reclining padded seats',
                                    'Complimentary bottled water',
                                    'Overhead luggage racks',
                                ],
                            ],
                            [
                                'name'  => 'Mercedes Sprinter',
                                'image' => asset('assets/image/coaster.jpg'),
                                'features' => [
                                    'European mid-size coach',
                                    'Full air conditioning',
                                    'Professional uniformed driver',
                                    'High-roof standing clearance',
                                    'Complimentary bottled water',
                                    'Premium sound system',
                                ],
                            ],
                            [
                                'name'  => 'Ford Transit',
                                'image' => asset('assets/image/coaster.jpg'),
                                'features' => [
                                    'Versatile group transport bus',
                                    'Full air conditioning',
                                    'Professional uniformed driver',
                                    'Flexible seating layout',
                                    'Complimentary bottled water',
                                    'Large luggage bay',
                                ],
                            ],
                        ],
                    ],
                    [
                        'name'       => 'Executive',
                        'price'      => 75000,
                        'passengers' => 'Up to 12 Passengers',
                        'images'     => [
                            asset('assets/image/coaster.jpg'),
                            asset('assets/image/coaster.jpg'),
                            asset('assets/image/coaster.jpg'),
                        ],
                        'models' => [
                            [
                                'name'  => 'Mercedes Sprinter Exec',
                                'image' => asset('assets/image/coaster.jpg'),
                                'features' => [
                                    'Executive configured Sprinter',
                                    'Full climate control',
                                    'Smartly dressed chauffeur',
                                    'Leather reclining seats',
                                    'Complimentary refreshments',
                                    'Onboard entertainment screens',
                                    'USB charging at every seat',
                                ],
                            ],
                            [
                                'name'  => 'Hyundai County',
                                'image' => asset('assets/image/coaster.jpg'),
                                'features' => [
                                    'Modern luxury mini-coach',
                                    'Full climate control',
                                    'Smartly dressed chauffeur',
                                    'Individual comfort seats',
                                    'Complimentary refreshments',
                                    'Overhead lighting per seat',
                                    'Large luggage compartment',
                                ],
                            ],
                            [
                                'name'  => 'Toyota Coaster Deluxe',
                                'image' => asset('assets/image/coaster.jpg'),
                                'features' => [
                                    'Deluxe edition luxury coaster',
                                    'Full climate control',
                                    'Smartly dressed chauffeur',
                                    'Reclining luxury seats',
                                    'Complimentary refreshments',
                                    'Onboard entertainment system',
                                    'USB charging at every seat',
                                ],
                            ],
                        ],
                    ],
                ],
            ],

            /* ====================================================================
            * LUXURY
            * Regular   = entry luxury (Genesis G80, Chrysler 300, Lincoln MKZ)
            * Standard  = mid luxury (Mercedes E-Class, BMW 5, Lexus ES)
            * Executive = top tier (S-Class, BMW 7, LS 500, Rolls-Royce Ghost)
            * ==================================================================== */
            'luxury' => [
                'fuel_rate_per_km' => 1300,
                'hourly_rate'      => 20000,
                'items' => [
                    [
                        'name'       => 'Regular',
                        'price'      => 40000,
                        'passengers' => '1 – 4 Passengers',
                        'images'     => [
                            asset('assets/image/limo.avif'),
                            asset('assets/image/limo.avif'),
                            asset('assets/image/limo.avif'),
                        ],
                        'models' => [
                            [
                                'name'  => 'Chrysler 300C',
                                'image' => asset('assets/image/limo.avif'),
                                'features' => [
                                    'Entry luxury full-size sedan',
                                    'Air conditioning',
                                    'Professional chauffeur',
                                    'Bold executive presence',
                                    'Premium leather interior',
                                    'Suitable for weddings & events',
                                ],
                            ],
                            [
                                'name'  => 'Genesis G80',
                                'image' => asset('assets/image/limo.avif'),
                                'features' => [
                                    'Korean premium luxury sedan',
                                    'Air conditioning',
                                    'Professional chauffeur',
                                    'Quilted Nappa leather seats',
                                    'Lexicon audio system',
                                    'Elegant corporate presence',
                                ],
                            ],
                            [
                                'name'  => 'Lincoln MKZ',
                                'image' => asset('assets/image/limo.avif'),
                                'features' => [
                                    'American luxury mid-size sedan',
                                    'Air conditioning',
                                    'Professional chauffeur',
                                    'Revel audio system',
                                    'Panoramic retractable roof',
                                    'Premium leather seating',
                                ],
                            ],
                        ],
                    ],
                    [
                        'name'       => 'Standard',
                        'price'      => 55000,
                        'passengers' => '1 – 4 Passengers',
                        'images'     => [
                            asset('assets/image/limo.avif'),
                            asset('assets/image/limo.avif'),
                            asset('assets/image/limo.avif'),
                        ],
                        'models' => [
                            [
                                'name'  => 'Mercedes E-Class',
                                'image' => asset('assets/image/limo.avif'),
                                'features' => [
                                    'European mid-range luxury sedan',
                                    'Full climate control',
                                    'Smartly dressed chauffeur',
                                    'Burmester audio system',
                                    'Complimentary champagne on request',
                                    'Privacy partition available',
                                    'Meet & greet service',
                                ],
                            ],
                            [
                                'name'  => 'BMW 5 Series',
                                'image' => asset('assets/image/limo.avif'),
                                'features' => [
                                    'The ultimate executive driving machine',
                                    'Full climate control',
                                    'Smartly dressed chauffeur',
                                    'Harman Kardon audio',
                                    'Complimentary champagne on request',
                                    'Panoramic glass roof',
                                    'Meet & greet service',
                                ],
                            ],
                            [
                                'name'  => 'Lexus ES 350',
                                'image' => asset('assets/image/limo.avif'),
                                'features' => [
                                    'Japanese premium executive sedan',
                                    'Full climate control',
                                    'Smartly dressed chauffeur',
                                    'Mark Levinson audio system',
                                    'Complimentary champagne on request',
                                    'Ultra-quiet cabin',
                                    'Meet & greet service',
                                ],
                            ],
                        ],
                    ],
                    [
                        'name'       => 'Executive',
                        'price'      => 75000,
                        'passengers' => '1 – 4 Passengers',
                        'images'     => [
                            asset('assets/image/limo.avif'),
                            asset('assets/image/limo.avif'),
                            asset('assets/image/limo.avif'),
                        ],
                        'models' => [
                            [
                                'name'  => 'Mercedes S-Class',
                                'image' => asset('assets/image/limo.avif'),
                                'features' => [
                                    'Pinnacle of luxury executive motoring',
                                    'Dual-zone climate control',
                                    'White-glove chauffeur service',
                                    'Burmester 4D surround sound',
                                    'Onboard bar & complimentary refreshments',
                                    'Privacy partition',
                                    'Red carpet meet & greet',
                                ],
                            ],
                            [
                                'name'  => 'BMW 7 Series',
                                'image' => asset('assets/image/limo.avif'),
                                'features' => [
                                    'Flagship BMW executive limousine',
                                    'Dual-zone climate control',
                                    'White-glove chauffeur service',
                                    'Bowers & Wilkins Diamond audio',
                                    'Onboard bar & complimentary refreshments',
                                    'Executive lounge rear seats',
                                    'Red carpet meet & greet',
                                ],
                            ],
                            [
                                'name'  => 'Lexus LS 500',
                                'image' => asset('assets/image/limo.avif'),
                                'features' => [
                                    'Japanese flagship ultra-luxury sedan',
                                    'Dual-zone climate control',
                                    'White-glove chauffeur service',
                                    'Shiatsu massage rear seats',
                                    'Champagne & complimentary refreshments',
                                    'Privacy partition',
                                    'Flower arrangement on request',
                                ],
                            ],
                            [
                                'name'  => 'Rolls-Royce Ghost',
                                'image' => asset('assets/image/limo.avif'),
                                'features' => [
                                    'The world\'s finest luxury automobile',
                                    'Whisper-quiet climate control',
                                    'White-glove chauffeur service',
                                    'Bespoke starlight headliner',
                                    'Dom Pérignon champagne service',
                                    'Privacy partition',
                                    'Red carpet arrival experience',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $transferVehicles = [

            'saloon' => [
                'thumb'  => asset('assets/image/saloon.jpg'),
                'models' => [
                    [
                        'name'        => 'Toyota Camry',
                        'rate_per_km' => 350,
                        'passengers'  => '1 – 3 Passengers',
                        'images'      => [
                            asset('assets/image/saloon.jpg'),
                            asset('assets/image/saloon.jpg'),
                            asset('assets/image/saloon.jpg'),
                        ],
                        'features' => [
                            'Air conditioning',
                            'Professional uniformed driver',
                            'Comfortable leather seats',
                            'Complimentary bottled water',
                            'Spacious boot for luggage',
                            'Meet & greet available',
                        ],
                    ],
                    [
                        'name'        => 'Honda Accord',
                        'rate_per_km' => 350,
                        'passengers'  => '1 – 3 Passengers',
                        'images'      => [
                            asset('assets/image/saloon.jpg'),
                            asset('assets/image/saloon.jpg'),
                            asset('assets/image/saloon.jpg'),
                        ],
                        'features' => [
                            'Air conditioning',
                            'Professional driver',
                            'Premium interior finish',
                            'Complimentary bottled water',
                            'Adequate boot space',
                        ],
                    ],
                    [
                        'name'        => 'Toyota Avalon',
                        'rate_per_km' => 400,
                        'passengers'  => '1 – 3 Passengers',
                        'images'      => [
                            asset('assets/image/saloon.jpg'),
                            asset('assets/image/saloon.jpg'),
                            asset('assets/image/saloon.jpg'),
                        ],
                        'features' => [
                            'Full climate control',
                            'Smartly dressed chauffeur',
                            'Premium leather interior',
                            'Complimentary refreshments',
                            'Panoramic sunroof',
                            'Meet & greet service',
                        ],
                    ],
                ],
            ],

            'suv' => [
                'thumb'  => asset('assets/image/suv.jpg'),
                'models' => [
                    [
                        'name'        => 'Toyota Highlander',
                        'rate_per_km' => 500,
                        'passengers'  => '1 – 3 Passengers',
                        'images'      => [
                            asset('assets/image/suv.jpg'),
                            asset('assets/image/suv.jpg'),
                            asset('assets/image/suv.jpg'),
                        ],
                        'features' => [
                            'Air conditioning',
                            'Professional driver',
                            'Spacious 3-row seating',
                            'Large boot capacity',
                            'Ideal for families & groups',
                        ],
                    ],
                    [
                        'name'        => 'Lexus RX 350',
                        'rate_per_km' => 600,
                        'passengers'  => '1 – 3 Passengers',
                        'images'      => [
                            asset('assets/image/suv.jpg'),
                            asset('assets/image/suv.jpg'),
                            asset('assets/image/suv.jpg'),
                        ],
                        'features' => [
                            'Full climate control',
                            'Smartly dressed chauffeur',
                            'Premium leather interior',
                            'Panoramic sunroof',
                            'Complimentary refreshments',
                            'Meet & greet service',
                        ],
                    ],
                    [
                        'name'        => 'Ford Explorer',
                        'rate_per_km' => 520,
                        'passengers'  => '1 – 3 Passengers',
                        'images'      => [
                            asset('assets/image/suv.jpg'),
                            asset('assets/image/suv.jpg'),
                            asset('assets/image/suv.jpg'),
                        ],
                        'features' => [
                            'Air conditioning',
                            'Professional uniformed driver',
                            'Ample boot space',
                            'Complimentary bottled water',
                            'Comfortable ride for long trips',
                        ],
                    ],
                ],
            ],

            'van' => [
                'thumb'  => asset('assets/image/minivan.png'),
                'models' => [
                    [
                        'name'        => 'Toyota HiAce',
                        'rate_per_km' => 650,
                        'passengers'  => 'Up to 5 Passengers',
                        'images'      => [
                            asset('assets/image/minivan.png'),
                            asset('assets/image/minivan.png'),
                            asset('assets/image/minivan.png'),
                        ],
                        'features' => [
                            'Air conditioning',
                            'Professional driver',
                            'Group-friendly seating',
                            'Luggage storage',
                            'Ideal for airport groups',
                        ],
                    ],
                    [
                        'name'        => 'Mercedes Vito',
                        'rate_per_km' => 800,
                        'passengers'  => 'Up to 5 Passengers',
                        'images'      => [
                            asset('assets/image/minivan.png'),
                            asset('assets/image/minivan.png'),
                            asset('assets/image/minivan.png'),
                        ],
                        'features' => [
                            'Full climate control',
                            'Smartly dressed chauffeur',
                            'Premium captain seats',
                            'USB charging ports',
                            'Complimentary refreshments',
                            'Wi-Fi on request',
                        ],
                    ],
                ],
            ],

            'bus' => [
                'thumb'  => asset('assets/image/coaster.jpg'),
                'models' => [
                    [
                        'name'        => 'Toyota Coaster',
                        'rate_per_km' => 900,
                        'passengers'  => 'Up to 12 Passengers',
                        'images'      => [
                            asset('assets/image/coaster.jpg'),
                            asset('assets/image/coaster.jpg'),
                            asset('assets/image/coaster.jpg'),
                        ],
                        'features' => [
                            'Air conditioning',
                            'Professional driver',
                            'Reclining seats',
                            'Luggage racks',
                            'Ideal for large groups',
                        ],
                    ],
                    [
                        'name'        => 'Mercedes Sprinter',
                        'rate_per_km' => 1000,
                        'passengers'  => 'Up to 12 Passengers',
                        'images'      => [
                            asset('assets/image/coaster.jpg'),
                            asset('assets/image/coaster.jpg'),
                            asset('assets/image/coaster.jpg'),
                        ],
                        'features' => [
                            'Full climate control',
                            'Smartly dressed chauffeur',
                            'Luxury reclining seats',
                            'Onboard entertainment',
                            'Complimentary refreshments',
                            'USB charging at every seat',
                        ],
                    ],
                ],
            ],

            'luxury' => [
                'thumb'  => asset('assets/image/limo.avif'),
                'models' => [
                    [
                        'name'        => 'Mercedes S-Class',
                        'rate_per_km' => 1200,
                        'passengers'  => '1 – 4 Passengers',
                        'images'      => [
                            asset('assets/image/limo.avif'),
                            asset('assets/image/limo.avif'),
                            asset('assets/image/limo.avif'),
                        ],
                        'features' => [
                            'Dual-zone climate control',
                            'White-glove chauffeur',
                            'Premium leather & wood trim',
                            'Complimentary refreshments',
                            'Privacy partition',
                            'Red carpet meet & greet',
                        ],
                    ],
                    [
                        'name'        => 'BMW 7 Series',
                        'rate_per_km' => 1200,
                        'passengers'  => '1 – 4 Passengers',
                        'images'      => [
                            asset('assets/image/limo.avif'),
                            asset('assets/image/limo.avif'),
                            asset('assets/image/limo.avif'),
                        ],
                        'features' => [
                            'Full climate control',
                            'Smartly dressed chauffeur',
                            'Executive leather seats',
                            'Ambient lighting',
                            'Complimentary refreshments',
                            'Meet & greet service',
                        ],
                    ],
                    [
                        'name'        => 'Lexus LS 500',
                        'rate_per_km' => 1300,
                        'passengers'  => '1 – 4 Passengers',
                        'images'      => [
                            asset('assets/image/limo.avif'),
                            asset('assets/image/limo.avif'),
                            asset('assets/image/limo.avif'),
                        ],
                        'features' => [
                            'Dual-zone climate control',
                            'White-glove chauffeur',
                            'Massage rear seats',
                            'Onboard entertainment system',
                            'Champagne on request',
                            'Privacy partition',
                            'Flower arrangement on request',
                        ],
                    ],
                ],
            ],

        ];

        $typeThumbs = [
            'saloon' => asset('assets/image/saloon.jpg'),
            'suv'    => asset('assets/image/suv.jpg'),
            'van'    => asset('assets/image/minivan.png'),
            'bus'    => asset('assets/image/coaster.jpg'),
            'luxury' => asset('assets/image/limo.avif'),
        ];

        return view('carhire.index', compact('categories', 'transferVehicles', 'typeThumbs'));
    }

    /*
    |--------------------------------------------------------------------------
    | PRIVATE DATA HELPERS  (server-side price verification only)
    |--------------------------------------------------------------------------
    */
    private function categoriesData(): array
    {
        return [
            'saloon'  => ['fuel_rate_per_km' => 1300, 'hourly_rate' => 5000,  'items' => [
                ['name' => 'Regular',   'price' => 15000],
                ['name' => 'Standard',  'price' => 20000],
                ['name' => 'Executive', 'price' => 30000],
            ]],
            'suv'     => ['fuel_rate_per_km' => 1300, 'hourly_rate' => 8000,  'items' => [
                ['name' => 'Regular',   'price' => 30000],
                ['name' => 'Standard',  'price' => 40000],
                ['name' => 'Executive', 'price' => 60000],
            ]],
            'van'     => ['fuel_rate_per_km' => 1300, 'hourly_rate' => 10000, 'items' => [
                ['name' => 'Regular',   'price' => 40000],
                ['name' => 'Standard',  'price' => 55000],
                ['name' => 'Executive', 'price' => 75000],
            ]],
            'bus'     => ['fuel_rate_per_km' => 1300, 'hourly_rate' => 15000, 'items' => [
                ['name' => 'Regular',   'price' => 40000],
                ['name' => 'Standard',  'price' => 55000],
                ['name' => 'Executive', 'price' => 75000],
            ]],
            'luxury'  => ['fuel_rate_per_km' => 1300, 'hourly_rate' => 20000, 'items' => [
                ['name' => 'Regular',   'price' => 40000],
                ['name' => 'Standard',  'price' => 55000],
                ['name' => 'Executive', 'price' => 75000],
            ]],
        ];
    }

    private function transferVehiclesData(): array
    {
        return [
            ['type' => 'saloon', 'name' => 'Toyota Camry',             'rate_per_km' => 350],
            ['type' => 'saloon', 'name' => 'Honda Accord',             'rate_per_km' => 350],
            ['type' => 'saloon', 'name' => 'Toyota Avalon',            'rate_per_km' => 400],
            ['type' => 'suv',    'name' => 'Toyota Highlander',        'rate_per_km' => 500],
            ['type' => 'suv',    'name' => 'Lexus RX 350',             'rate_per_km' => 600],
            ['type' => 'suv',    'name' => 'Ford Explorer',            'rate_per_km' => 520],
            ['type' => 'van',    'name' => 'Toyota HiAce',             'rate_per_km' => 650],
            ['type' => 'van',    'name' => 'Mercedes Vito',            'rate_per_km' => 800],
            ['type' => 'bus',    'name' => 'Toyota Coaster',           'rate_per_km' => 900],
            ['type' => 'bus',    'name' => 'Mercedes Sprinter',        'rate_per_km' => 1000],
            ['type' => 'luxury', 'name' => 'Mercedes S-Class',         'rate_per_km' => 1200],
            ['type' => 'luxury', 'name' => 'BMW 7 Series',             'rate_per_km' => 1200],
            ['type' => 'luxury', 'name' => 'Lexus LS 500',             'rate_per_km' => 1300],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | GOOGLE MAPS DISTANCE PROXY
    |--------------------------------------------------------------------------
    */
    public function distance(Request $request)
    {
        $request->validate([
            'origin'      => 'required|string|max:500',
            'destination' => 'required|string|max:500',
        ]);

        $apiKey = config('services.google.maps_key');
        if (!$apiKey) {
            return response()->json(['error' => 'Maps API not configured.'], 500);
        }

        $origin = ($request->filled('origin_lat') && $request->filled('origin_lng'))
            ? $request->origin_lat . ',' . $request->origin_lng
            : $request->origin;

        $destination = ($request->filled('dest_lat') && $request->filled('dest_lng'))
            ? $request->dest_lat . ',' . $request->dest_lng
            : $request->destination;

        try {
            $response = Http::get('https://maps.googleapis.com/maps/api/distancematrix/json', [
                'origins'      => $origin,
                'destinations' => $destination,
                'units'        => 'metric',
                'region'       => 'NG',
                'key'          => $apiKey,
            ]);

            $data = $response->json();

            if (($data['status'] ?? '') !== 'OK') {
                Log::warning('Google Maps Distance API error', ['status' => $data['status'] ?? 'unknown']);
                return response()->json(['error' => 'Google API error: ' . ($data['status'] ?? 'UNKNOWN')], 500);
            }

            $element = $data['rows'][0]['elements'][0] ?? null;
            if (!$element || ($element['status'] ?? '') !== 'OK') {
                return response()->json(['error' => 'No route found. Status: ' . ($element['status'] ?? 'N/A')], 400);
            }

            $distanceKm  = max(1, (int) ceil($element['distance']['value'] / 1000));
            $durationMins = (int) ceil($element['duration']['value'] / 60);
            $driveTime   = $durationMins >= 60
                ? floor($durationMins / 60) . 'h ' . ($durationMins % 60 > 0 ? ($durationMins % 60) . 'm' : '')
                : $durationMins . ' mins';

            return response()->json([
                'distance_km'   => $distanceKm,
                'distance_text' => $element['distance']['text'],
                'duration_text' => $element['duration']['text'],
                'drive_time'    => trim($driveTime),
            ]);

        } catch (\Exception $e) {
            Log::error('Google Maps Distance Exception', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Distance calculation failed. Please try again.'], 500);
        }
    }

    /*
    |==========================================================================
    | CAR HIRE — submit, callbacks, success
    |==========================================================================
    */
    public function submitCarHire(Request $request)
    {
        $data = $request->validate([
            'car_type'         => 'required|string',
            'category'         => 'required|string',
            'car_model'        => 'required|string|max:100',   // ← NEW
            'price'            => 'required|numeric|min:0',
            'distance_km'      => 'required|numeric|min:1',
            'rental_hours'     => 'required|numeric|min:1',
            'full_name'        => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'phone_number'     => 'required|string|max:20',
            'passengers'       => 'required|integer|min:1',
            'pickup_location'  => 'required|string|max:255',
            'dropoff_location' => 'required|string|max:255',
            'pickup_date'      => 'required|date',
            'pickup_time'      => 'required',
            'payment_option'   => 'required|in:budpay,seerbit',
        ]);

        $allCats       = $this->categoriesData();
        $typeData      = $allCats[$data['car_type']] ?? null;
        $catItem       = collect($typeData['items'] ?? [])->firstWhere('name', $data['category']);
        $basePrice     = $catItem['price'] ?? 0;
        $verifiedPrice = $basePrice
            + ($data['distance_km'] * ($typeData['fuel_rate_per_km'] ?? 0))
            + ($data['rental_hours'] * ($typeData['hourly_rate'] ?? 0));

        $reference = 'CARHIRE-' . strtoupper(bin2hex(random_bytes(5)));

        CarHire::create([
            'car_type'          => $data['car_type'],
            'category'          => $data['category'],
            'car_model'         => $data['car_model'],          // ← NEW
            'full_name'         => $data['full_name'],
            'email'             => $data['email'],
            'phone_number'      => $data['phone_number'],
            'passengers'        => $data['passengers'],
            'pickup_location'   => $data['pickup_location'],
            'dropoff_location'  => $data['dropoff_location'],
            'pickup_date'       => $data['pickup_date'],
            'pickup_time'       => $data['pickup_time'],
            'distance_km'       => $data['distance_km'],
            'rental_hours'      => $data['rental_hours'],
            'amount'            => $verifiedPrice,
            'payment_option'    => $data['payment_option'],
            'payment_reference' => $reference,
            'payment_status'    => 'pending',
        ]);

        return $this->launchPayment(
            payment_option: $data['payment_option'],
            amount:         $verifiedPrice,
            email:          $data['email'],
            phone:          $data['phone_number'],
            customerName:   $data['full_name'],
            reference:      $reference,
            product_title:  'Car Hire — ' . ucfirst($data['car_type']) . ' · ' . $data['category'] . ' · ' . $data['car_model'],
            callback_route: 'carhire.budpay.callback',
            cancel_route:   'carhire.index',
            seerbit_route:  'carhire.seerbit.callback',
        );
    }

    public function budpayCallbackCarHire(Request $request)
    {
        return $this->handleBudpayCallback(
            request:      $request,
            model:        CarHire::class,
            product_type: 'car_hire',
            fail_route:   'carhire.index',
            success_route:'carhire.success',
        );
    }

    public function seerbitCallbackCarHire(Request $request)
    {
        return $this->handleSeerbitCallback(
            request:      $request,
            model:        CarHire::class,
            product_type: 'car_hire',
            fail_route:   'carhire.index',
            success_route:'carhire.success',
        );
    }

    public function successCarHire()
    {
        return view('carhire.success')
            ->with('success', session('success', 'Your Car Hire booking was confirmed!'));
    }

    /*
    |==========================================================================
    | TRANSFER — submit, callbacks, success
    |==========================================================================
    */
    public function submitTransfer(Request $request)
    {
        $data = $request->validate([
            'vehicle_type'      => 'required|string',
            'vehicle_name'      => 'required|string',
            'price'             => 'required|numeric|min:0',
            'distance_km'       => 'required|numeric|min:1',
            'pickup_location'   => 'required|string|max:255',
            'dropoff_location'  => 'required|string|max:255',
            'full_name'         => 'required|string|max:255',
            'email'             => 'required|email|max:255',
            'phone_number'      => 'required|string|max:20',
            'passengers'        => 'required|integer|min:1',
            'flight_number'     => 'nullable|string|max:50',
            'special_requests'  => 'nullable|string|max:500',
            'pickup_date'       => 'required|date',
            'pickup_time'       => 'required',
            'payment_option'    => 'required|in:budpay,seerbit',
        ]);

        $allModels     = $this->transferVehiclesData();
        $modelData     = collect($allModels)->firstWhere('name', $data['vehicle_name']);
        $ratePerKm     = $modelData['rate_per_km'] ?? 0;
        $verifiedPrice = $ratePerKm > 0
            ? (int) round($data['distance_km'] * $ratePerKm)
            : (int) $data['price'];

        $reference = 'TRANSFER-' . strtoupper(bin2hex(random_bytes(5)));

        Transfer::create([
            'vehicle_type'      => $data['vehicle_type'],
            'vehicle_name'      => $data['vehicle_name'],
            'amount'            => $verifiedPrice,
            'distance_km'       => $data['distance_km'],
            'pickup_location'   => $data['pickup_location'],
            'dropoff_location'  => $data['dropoff_location'],
            'full_name'         => $data['full_name'],
            'email'             => $data['email'],
            'phone_number'      => $data['phone_number'],
            'passengers'        => $data['passengers'],
            'flight_number'     => $data['flight_number']    ?? null,
            'special_requests'  => $data['special_requests'] ?? null,
            'pickup_date'       => $data['pickup_date'],
            'pickup_time'       => $data['pickup_time'],
            'payment_option'    => $data['payment_option'],
            'payment_reference' => $reference,
            'payment_status'    => 'pending',
        ]);

        return $this->launchPayment(
            payment_option: $data['payment_option'],
            amount:         $verifiedPrice,
            email:          $data['email'],
            phone:          $data['phone_number'],
            customerName:   $data['full_name'],
            reference:      $reference,
            product_title:  'Transfer — ' . $data['vehicle_name'] . ' (' . $data['distance_km'] . ' km)',
            callback_route: 'transfer.budpay.callback',
            cancel_route:   'carhire.index',
            seerbit_route:  'transfer.seerbit.callback',
        );
    }

    public function budpayCallbackTransfer(Request $request)
    {
        return $this->handleBudpayCallback(
            request:      $request,
            model:        Transfer::class,
            product_type: 'transfer',
            fail_route:   'carhire.index',
            success_route:'transfer.success',
        );
    }

    public function seerbitCallbackTransfer(Request $request)
    {
        return $this->handleSeerbitCallback(
            request:      $request,
            model:        Transfer::class,
            product_type: 'transfer',
            fail_route:   'carhire.index',
            success_route:'transfer.success',
        );
    }

    public function successTransfer()
    {
        return view('carhire.success')
            ->with('success', session('success', 'Your Transfer booking was confirmed!'));
    }

    /*
    |==========================================================================
    | SHARED PAYMENT LAUNCHER
    |==========================================================================
    */
    private function launchPayment(
        string $payment_option,
        float  $amount,
        string $email,
        string $phone,
        string $customerName,
        string $reference,
        string $product_title,
        string $callback_route,
        string $cancel_route,
        string $seerbit_route
    ) {
        if ($payment_option === 'seerbit') {
            return $this->launchSeerbitPayment(
                amount:        $amount,
                email:         $email,
                phone:         $phone,
                customerName:  $customerName,
                reference:     $reference,
                product_title: $product_title,
                seerbit_route: $seerbit_route,
            );
        }

        $publicKey   = env('BUDPAY_PUBLIC_KEY');
        $callbackUrl = route($callback_route);
        $cancelUrl   = route($cancel_route);
        $firstName   = explode(' ', $customerName)[0];
        $lastName    = explode(' ', $customerName)[1] ?? '';

        return response()->make('
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>Redirecting to BudPay</title>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <script src="https://inlinepay.budpay.com/budpay-inline-custom.js"></script>
                <style>
                    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
                    body { font-family: "DM Sans", "Segoe UI", Arial, sans-serif; background: #f7f6f2; display: flex; align-items: center; justify-content: center; height: 100vh; }
                    .payment-card { background: #fff; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); padding: 48px 36px; max-width: 420px; width: 100%; text-align: center; animation: fadeIn 0.5s ease-in-out; }
                    .logo-bar img { height: 32px; margin-bottom: 24px; }
                    h2 { font-size: 1.25rem; color: #1a1a1a; margin-bottom: 6px; }
                    .sub { color: #777; font-size: 0.875rem; margin-bottom: 24px; }
                    .amount-box { font-size: 2rem; font-weight: 700; color: #0d1883; margin-bottom: 28px; }
                    #payBtn { background: linear-gradient(135deg, #0d1883, #2d39b6); color: #fff; border: none; border-radius: 12px; padding: 14px 28px; font-size: 0.95rem; font-weight: 600; cursor: pointer; width: 100%; transition: background 0.2s, transform 0.15s; }
                    #payBtn:hover { background: #0b1570; transform: translateY(-1px); }
                    #payBtn:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }
                    .loader { display: none; margin: 16px auto 0; border: 3px solid #eee; border-top-color: #0d1883; border-radius: 50%; width: 28px; height: 28px; animation: spin 0.8s linear infinite; }
                    .secure-note { margin-top: 18px; font-size: 0.8rem; color: #aaa; }
                    @keyframes fadeIn { from { opacity:0; transform:translateY(8px); } to { opacity:1; transform:translateY(0); } }
                    @keyframes spin   { to { transform:rotate(360deg); } }
                </style>
            </head>
            <body>
                <div class="payment-card">
                    <div class="logo-bar">
                        <img src="https://travelwheel.ng/public/assetsU/assets/img/favicon/twlogo.png" alt="TravelWheel Logo">
                    </div>
                    <h2>Complete Your Payment</h2>
                    <p class="sub">You are about to pay for <strong>' . $product_title . '</strong></p>
                    <div class="amount-box">₦' . number_format($amount) . '</div>
                    <button id="payBtn">Proceed to Pay Securely</button>
                    <div class="loader" id="loader"></div>
                    <p class="secure-note">🔒 Secured by BudPay · NGN payment</p>
                </div>
                <script>
                    const payBtn = document.getElementById("payBtn");
                    const loader = document.getElementById("loader");
                    payBtn.addEventListener("click", function () {
                        loader.style.display = "block";
                        payBtn.disabled = true;
                        payBtn.textContent = "Launching...";
                        BudPayCheckout({
                            key:          "' . $publicKey . '",
                            email:        "' . $email . '",
                            amount:       "' . $amount . '",
                            first_name:   "' . $firstName . '",
                            last_name:    "' . $lastName . '",
                            currency:     "NGN",
                            reference:    "' . $reference . '",
                            callback_url: "' . $callbackUrl . '",
                            onSuccess: function (res) {
                                window.location.href = "' . $callbackUrl . '?reference=" + res.reference;
                            },
                            onClose: function () {
                                loader.style.display = "none";
                                payBtn.disabled = false;
                                payBtn.textContent = "Proceed to Pay Securely";
                                window.location.href = "' . $cancelUrl . '?payment=cancelled";
                            }
                        });
                    });
                </script>
            </body>
            </html>
        ');
    }

    private function launchSeerbitPayment(
        float  $amount,
        string $email,
        string $phone,
        string $customerName,
        string $reference,
        string $product_title,
        string $seerbit_route
    ) {
        try {
            $callbackUrl = route($seerbit_route);
            $payload = [
                'amount'             => $amount,
                'callbackUrl'        => $callbackUrl,
                'country'            => 'NG',
                'currency'           => 'NGN',
                'email'              => $email,
                'client_name'        => $customerName,
                'paymentReference'   => $reference,
                'productDescription' => $product_title,
                'productId'          => 'PRD' . $reference,
            ];
            $response = SeerBit::Standard()->Initialize($payload);
            if (isset($response['data']['payments']['redirectLink']) && !empty($response['data']['payments']['redirectLink'])) {
                return redirect($response['data']['payments']['redirectLink']);
            }
            Log::error('SeerBit Init Failed', ['reference' => $reference, 'response' => $response]);
            return back()->with('error', 'Unable to start SeerBit payment. Please try again.');
        } catch (\Exception $e) {
            Log::error('SeerBit Init Exception', ['reference' => $reference, 'error' => $e->getMessage()]);
            return back()->with('error', 'SeerBit Error: ' . $e->getMessage());
        }
    }

    /*
    |==========================================================================
    | SHARED CALLBACK HANDLERS
    |==========================================================================
    */
    private function handleBudpayCallback(
        Request $request,
        string  $model,
        string  $product_type,
        string  $fail_route,
        string  $success_route
    ) {
        $reference = $request->query('reference');

        if (!$reference) {
            return redirect()->route($fail_route)->with('error', 'Missing payment reference. Please contact support.');
        }

        try {
            $verify = Http::withToken(env('BUDPAY_SECRET_KEY'))
                ->get("https://api.budpay.com/api/v2/transaction/verify/{$reference}");

            if ($verify->failed()) {
                Log::error($product_type . ' BudPay Verify Failed', ['reference' => $reference]);
                return redirect()->route($fail_route)->with('error', 'Payment gateway error. Please contact support.');
            }

            $data      = $verify->json();
            $txnStatus = $data['data']['transaction_status'] ?? $data['data']['status'] ?? null;

            if (!in_array($txnStatus, ['success', 'completed'])) {
                return redirect()->route($fail_route)
                    ->with('error', 'Payment was not completed. Status: ' . ($txnStatus ?? 'Unknown'));
            }

            $record = $model::where('payment_reference', $reference)->first();

            if (!$record) {
                return redirect()->route($fail_route)->with('error', 'Payment received but booking not found. Please contact support.');
            }

            if ($record->payment_status !== 'paid') {
                $record->update(['payment_status' => 'paid']);
                $this->sendMails($record, $product_type);
            }

            $successMessage = $product_type === 'car_hire'
                ? 'Car Hire booking confirmed! Your vehicle is reserved.'
                : 'Transfer booking confirmed! Your vehicle is reserved.';

            return redirect()->route($success_route)->with('success', $successMessage);

        } catch (\Exception $e) {
            Log::error($product_type . ' BudPay Callback Exception', ['reference' => $reference, 'error' => $e->getMessage()]);
            return redirect()->route($fail_route)->with('error', 'Error verifying payment. Please contact support.');
        }
    }

    private function handleSeerbitCallback(
        Request $request,
        string  $model,
        string  $product_type,
        string  $fail_route,
        string  $success_route
    ) {
        $reference = $request->query('reference');
        $message   = $request->query('message');

        if (strtolower($message) !== 'successful') {
            return redirect()->route($fail_route)->with('error', 'Payment failed or was cancelled. Please try again.');
        }

        $record = $model::where('payment_reference', $reference)->first();

        if (!$record) {
            return redirect()->route($fail_route)->with('error', 'Payment received but booking not found. Please contact support.');
        }

        if ($record->payment_status !== 'paid') {
            $record->update(['payment_status' => 'paid']);
            $this->sendMails($record, $product_type);
        }

        $successMessage = $product_type === 'car_hire'
            ? 'Car Hire booking confirmed! Your vehicle is reserved.'
            : 'Transfer booking confirmed! Your vehicle is reserved.';

        return redirect()->route($success_route)->with('success', $successMessage);
    }

    /*
    |==========================================================================
    | MAIL SENDER
    |==========================================================================
    */
    private function sendMails($record, string $product_type): void
    {
        $supportMail = 'damilola@travelwheel.ng';

        try {
            switch ($product_type) {
                case 'car_hire':
                    Mail::to($record->email)->send(new \App\Mail\CarHireSuccessMail($record));
                    Mail::to($supportMail)->send(new \App\Mail\CarHireNotificationMail($record));
                    break;
                case 'transfer':
                    Mail::to($record->email)->send(new \App\Mail\TransferSuccessMail($record));
                    Mail::to($supportMail)->send(new \App\Mail\TransferNotificationMail($record));
                    break;
                default:
                    Log::warning('sendMails: unknown product_type', ['product_type' => $product_type]);
                    break;
            }
        } catch (\Exception $e) {
            Log::error('Mail Error for ' . $product_type, [
                'reference' => $record->payment_reference ?? 'unknown',
                'error'     => $e->getMessage(),
            ]);
        }
    }
}