<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\KnowledgeArticle;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Post;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['admin', 'manager', 'staff'] as $role) {
            Role::findOrCreate($role);
        }

        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Westforge Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '(503) 555-0187',
            ]
        );
        $admin->assignRole('admin');

        $manager = User::query()->updateOrCreate(
            ['email' => 'manager@westforgecloset.com'],
            [
                'name' => 'Ava Meridian',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'phone' => '(503) 555-0191',
            ]
        );
        $manager->assignRole('manager');

        $staff = User::query()->updateOrCreate(
            ['email' => 'installer@westforgecloset.com'],
            [
                'name' => 'Jonah Reed',
                'password' => Hash::make('password'),
                'role' => 'staff',
                'phone' => '(503) 555-0194',
            ]
        );
        $staff->assignRole('staff');

        Setting::set('company_name', 'Westforge Closet Co.');
        Setting::set('company_phone', '(503) 555-0187');
        Setting::set('company_email', 'hello@westforgecloset.com');
        Setting::set('company_address', '2140 NW Thurman St, Portland, OR 97210');
        Setting::set('whatsapp', '+15035550187');
        Setting::set('tax_rate', '0.00');

        $services = [
            [
                'title' => 'Custom Walk-In Closets',
                'slug' => 'custom-walk-in-closets',
                'icon' => 'walk-in',
                'summary' => 'Factory-built walk-in suites with islands, glass fronts, and LED lighting.',
                'body' => '<p>Westforge manufactures walk-in closet systems as CNC-nested panel packages. Choose frameless European or transitional Shaker lines, then configure hanging zones, drawers, jewelry trays, and optional center islands.</p><p>Every suite is measured with lasers, cut in our Portland plant, and installed by certified crews.</p>',
                'image' => 'https://images.unsplash.com/photo-1595428774223-ef52624120d2?auto=format&fit=crop&w=1400&q=80',
                'starting_price' => 6500,
                'sort_order' => 1,
            ],
            [
                'title' => 'Reach-In Closet Systems',
                'slug' => 'reach-in-closet-systems',
                'icon' => 'reach-in',
                'summary' => 'High-density reach-in organizers that reclaim wasted vertical space.',
                'body' => '<p>Our reach-in systems convert builder-grade rods into multi-level hanging, adjustable shelving, and soft-close drawers. Ideal for bedrooms, guest rooms, and kids\' spaces.</p>',
                'image' => 'https://images.unsplash.com/photo-1558997519-83ea9252edf8?auto=format&fit=crop&w=1400&q=80',
                'starting_price' => 1800,
                'sort_order' => 2,
            ],
            [
                'title' => 'Wardrobe Wall Manufacturing',
                'slug' => 'wardrobe-wall-manufacturing',
                'icon' => 'wardrobe',
                'summary' => 'Floor-to-ceiling wardrobe walls for open bedrooms and lofts.',
                'body' => '<p>When a room has no closet, Westforge builds a full wardrobe wall with integrated lighting, mirrored doors, and modular interiors that ship ready to install.</p>',
                'image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1400&q=80',
                'starting_price' => 4200,
                'sort_order' => 3,
            ],
            [
                'title' => 'Mudroom & Entry Lockers',
                'slug' => 'mudroom-entry-lockers',
                'icon' => 'mudroom',
                'summary' => 'Durable lockers, benches, and cubbies manufactured for busy households.',
                'body' => '<p>From coated hooks to ventilated cubbies, our mudroom systems are built for wet gear, backpacks, and daily traffic without looking utilitarian.</p>',
                'image' => 'https://images.unsplash.com/photo-1600210492493-0946911123ea?auto=format&fit=crop&w=1400&q=80',
                'starting_price' => 2400,
                'sort_order' => 4,
            ],
            [
                'title' => 'Pantry Closet Builds',
                'slug' => 'pantry-closet-builds',
                'icon' => 'pantry',
                'summary' => 'Deep-shelf pantry closets with pull-outs and appliance garages.',
                'body' => '<p>Westforge pantry packages maximize vertical storage with pull-out trays, door racks, and adjustable shelves sized for bulk goods.</p>',
                'image' => 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?auto=format&fit=crop&w=1400&q=80',
                'starting_price' => 2100,
                'sort_order' => 5,
            ],
            [
                'title' => 'Factory Design & CNC Nesting',
                'slug' => 'factory-design-cnc-nesting',
                'icon' => 'cnc',
                'summary' => 'Design-to-manufacture services for remodelers and builders.',
                'body' => '<p>Partner with our design desk for shop drawings, hardware schedules, and CNC nests. We can ship white-labeled packages to approved installers nationwide.</p>',
                'image' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=1400&q=80',
                'starting_price' => 900,
                'sort_order' => 6,
            ],
        ];

        foreach ($services as $service) {
            Service::query()->updateOrCreate(['slug' => $service['slug']], $service + ['is_active' => true]);
        }

        $products = [
            ['name' => 'Matte White Side Panel 96"', 'sku' => 'WF-PNL-WHT-96', 'category' => 'panels', 'unit_cost' => 48, 'unit_price' => 96, 'stock_qty' => 120],
            ['name' => 'Walnut Veneer Side Panel 96"', 'sku' => 'WF-PNL-WAL-96', 'category' => 'panels', 'unit_cost' => 72, 'unit_price' => 148, 'stock_qty' => 64],
            ['name' => 'Aluminum Hanging Rail 8ft', 'sku' => 'WF-RAIL-ALU-8', 'category' => 'rails', 'unit_cost' => 18, 'unit_price' => 42, 'stock_qty' => 200],
            ['name' => 'Soft-Close Drawer Slide Pair', 'sku' => 'WF-HW-SLIDE-SC', 'category' => 'hardware', 'unit_cost' => 14, 'unit_price' => 32, 'stock_qty' => 8],
            ['name' => 'LED Closet Strip Kit', 'sku' => 'WF-ACC-LED-KIT', 'category' => 'accessories', 'unit_cost' => 22, 'unit_price' => 59, 'stock_qty' => 45],
            ['name' => 'Velvet Jewelry Tray Insert', 'sku' => 'WF-ACC-JWL-TR', 'category' => 'accessories', 'unit_cost' => 11, 'unit_price' => 28, 'stock_qty' => 70],
            ['name' => 'Walk-In Starter System', 'sku' => 'WF-SYS-WALK-01', 'category' => 'systems', 'unit_cost' => 1800, 'unit_price' => 4200, 'stock_qty' => 12],
            ['name' => 'Reach-In Starter System', 'sku' => 'WF-SYS-REACH-01', 'category' => 'systems', 'unit_cost' => 620, 'unit_price' => 1650, 'stock_qty' => 18],
        ];

        foreach ($products as $product) {
            Product::query()->updateOrCreate(
                ['sku' => $product['sku']],
                $product + [
                    'description' => $product['name'].' stocked for Westforge manufacturing runs.',
                    'reorder_level' => 10,
                    'unit' => 'each',
                    'is_active' => true,
                ]
            );
        }

        $customers = collect([
            ['name' => 'Elena Vargas', 'email' => 'elena@example.com', 'phone' => '(503) 555-2201', 'city' => 'Portland', 'state' => 'OR', 'zip' => '97209'],
            ['name' => 'Marcus Hill', 'email' => 'marcus@example.com', 'phone' => '(971) 555-8832', 'city' => 'Beaverton', 'state' => 'OR', 'zip' => '97005'],
            ['name' => 'Priya Shah', 'email' => 'priya@example.com', 'phone' => '(503) 555-4410', 'city' => 'Lake Oswego', 'state' => 'OR', 'zip' => '97034'],
            ['name' => 'Noah Bennett', 'email' => 'noah@example.com', 'phone' => '(541) 555-1190', 'city' => 'Bend', 'state' => 'OR', 'zip' => '97701'],
            ['name' => 'Harper Cole Homes', 'email' => 'ops@harpercole.com', 'phone' => '(503) 555-7788', 'company' => 'Harper Cole Homes', 'city' => 'Portland', 'state' => 'OR', 'zip' => '97214'],
        ])->map(fn ($c) => Customer::query()->updateOrCreate(
            ['email' => $c['email']],
            $c + ['address' => '123 Design Ave', 'notes' => 'Seeded demo customer']
        ));

        $orderDefs = [
            ['title' => 'Primary suite walk-in', 'closet_type' => 'walk-in', 'finish' => 'Walnut veneer', 'status' => 'in_production', 'total' => 12450],
            ['title' => 'Kids reach-in refresh', 'closet_type' => 'reach-in', 'finish' => 'Matte white', 'status' => 'approved', 'total' => 2850],
            ['title' => 'Mudroom locker wall', 'closet_type' => 'mudroom', 'finish' => 'Slate paint', 'status' => 'ready_for_install', 'total' => 4620],
            ['title' => 'Guest wardrobe wall', 'closet_type' => 'wardrobe', 'finish' => 'Greige laminate', 'status' => 'quoted', 'total' => 5180],
            ['title' => 'Pantry pull-out package', 'closet_type' => 'pantry', 'finish' => 'Matte white', 'status' => 'installed', 'total' => 3120],
        ];

        foreach ($orderDefs as $i => $def) {
            $customer = $customers[$i % $customers->count()];
            $order = Order::query()->updateOrCreate(
                ['order_number' => 'WF-'.str_pad((string) ($i + 1001), 4, '0', STR_PAD_LEFT)],
                [
                    'customer_id' => $customer->id,
                    'assigned_to' => $i % 2 === 0 ? $manager->id : $staff->id,
                    'title' => $def['title'],
                    'closet_type' => $def['closet_type'],
                    'finish' => $def['finish'],
                    'status' => $def['status'],
                    'order_date' => now()->subDays(20 - $i * 3),
                    'due_date' => now()->addDays(10 + $i),
                    'install_date' => $def['status'] === 'installed' ? now()->subDays(2) : now()->addDays(14 + $i),
                    'subtotal' => $def['total'] * 0.92,
                    'tax' => $def['total'] * 0.08,
                    'total' => $def['total'],
                    'notes' => 'Demo manufacturing order',
                    'created_at' => now()->subMonths(5 - ($i % 6))->addDays($i),
                ]
            );

            OrderItem::query()->updateOrCreate(
                ['order_id' => $order->id, 'description' => $def['title'].' package'],
                [
                    'product_id' => Product::query()->inRandomOrder()->value('id'),
                    'quantity' => 1,
                    'unit_price' => $def['total'],
                    'line_total' => $def['total'],
                ]
            );

            $invoice = Invoice::query()->updateOrCreate(
                ['invoice_number' => 'INV-'.str_pad((string) ($i + 2001), 4, '0', STR_PAD_LEFT)],
                [
                    'customer_id' => $customer->id,
                    'order_id' => $order->id,
                    'status' => $def['status'] === 'installed' ? 'paid' : ($i % 2 ? 'sent' : 'partial'),
                    'issue_date' => now()->subDays(15 - $i),
                    'due_date' => now()->addDays(15),
                    'subtotal' => $order->subtotal,
                    'tax' => $order->tax,
                    'total' => $order->total,
                    'amount_paid' => $def['status'] === 'installed' ? $order->total : $order->total * 0.4,
                ]
            );

            Payment::query()->updateOrCreate(
                ['invoice_id' => $invoice->id, 'reference' => 'PAY-'.$invoice->invoice_number],
                [
                    'amount' => $invoice->amount_paid,
                    'method' => 'card',
                    'paid_at' => now()->subDays(10 - $i)->toDateString(),
                    'notes' => 'Deposit / progress payment',
                ]
            );

            Appointment::query()->updateOrCreate(
                ['title' => $def['title'].' appointment', 'customer_id' => $customer->id],
                [
                    'assigned_to' => $staff->id,
                    'type' => $def['status'] === 'ready_for_install' ? 'install' : 'measure',
                    'status' => 'scheduled',
                    'starts_at' => now()->addDays($i + 1)->setTime(10, 0),
                    'ends_at' => now()->addDays($i + 1)->setTime(12, 0),
                    'location' => $customer->city.', '.$customer->state,
                    'notes' => 'Bring laser measure and finish samples.',
                ]
            );
        }

        $posts = [
            [
                'title' => 'How CNC Nesting Improves Custom Closet Fit',
                'cover_image' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Why factory nesting beats stick-built closet installs for tight Portland homes.',
                'body' => '<p>Westforge Closet Co. runs every panel through nesting software before the CNC spindle starts. That means fewer voids, cleaner edges, and installs that finish on schedule.</p>',
            ],
            [
                'title' => 'Choosing Finishes for High-Humidity Closets',
                'cover_image' => 'https://images.unsplash.com/photo-1615874959474-d609969a20ed?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Thermofoil vs veneer vs paint for Pacific Northwest moisture.',
                'body' => '<p>Coastal moisture can swell particleboard. We specify furniture-grade plywood cores and sealed edges so walk-ins stay true through rainy seasons.</p>',
            ],
            [
                'title' => 'Walk-In Lighting Layouts That Feel Boutique',
                'cover_image' => 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'LED strips, puck lights, and motion sensors for everyday luxury.',
                'body' => '<p>Lighting is designed with the manufacturing package — not added as an afterthought — so wiring channels and switch locations are cut at the factory.</p>',
            ],
            [
                'title' => 'Builder Partnerships: Specifying Closets Once',
                'cover_image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'How remodelers lock closet packages into their bid templates.',
                'body' => '<p>Harper Cole Homes and other partners use Westforge SKUs so every Phase One home gets consistent reach-ins without redesigning from scratch.</p>',
            ],
        ];

        foreach ($posts as $post) {
            Post::query()->updateOrCreate(
                ['slug' => Str::slug($post['title'])],
                $post + [
                    'category' => 'blog',
                    'is_published' => true,
                    'published_at' => now()->subDays(rand(2, 40)),
                    'author_id' => $admin->id,
                ]
            );
        }

        $kb = [
            [
                'title' => 'Door hangs crooked after install',
                'category' => 'common-issues',
                'body' => '<p>1. Confirm hinge plate screws bite into solid backing.<br>2. Adjust lateral cam until reveal is even.<br>3. Check floor level — shim the toe kick if the carcass racks.</p>',
            ],
            [
                'title' => 'Soft-close drawer will not latch',
                'category' => 'common-issues',
                'body' => '<p>Clear debris from the slide race, reseat the trigger, and verify the drawer box is square within 1mm before replacing hardware.</p>',
            ],
            [
                'title' => 'From consult to CNC: production checklist',
                'category' => 'guides',
                'body' => '<ol><li>Capture laser measure PDF</li><li>Approve finish sample</li><li>Collect 40% deposit invoice</li><li>Nest panels and print labels</li><li>Stage hardware kit</li><li>Schedule install crew</li></ol>',
            ],
            [
                'title' => 'Homeowner prep before install day',
                'category' => 'guides',
                'body' => '<p>Clear the closet, remove old rods, protect adjacent flooring, and reserve driveway space for the delivery truck.</p>',
            ],
            [
                'title' => 'Filament admin quick start',
                'category' => 'admin-manual',
                'body' => '<p>Log in at <code>/admin</code> with admin@example.com. Use CRM for customers, Operations for closet orders and appointments, Inventory for panels/hardware, and AI Tools for content or shop diagnostics.</p>',
            ],
            [
                'title' => 'Managing low stock before a production run',
                'category' => 'admin-manual',
                'body' => '<p>Open Products, sort by stock qty, and reorder anything at or below reorder level. Soft-close slides are commonly the first bottleneck.</p>',
            ],
            [
                'title' => 'CNC edge chip on walnut veneer',
                'category' => 'troubleshooting',
                'body' => '<p>Reduce feed rate, confirm climb-cut direction, and replace dull bits. Seal edges immediately after cut to prevent moisture ingress.</p>',
            ],
            [
                'title' => 'Invoice balance not matching payments',
                'category' => 'troubleshooting',
                'body' => '<p>Recalculate amount_paid from the Payments relation, then set invoice status to partial/paid. Never edit totals without linking a payment record.</p>',
            ],
        ];

        foreach ($kb as $i => $article) {
            KnowledgeArticle::query()->updateOrCreate(
                ['slug' => Str::slug($article['title'])],
                $article + ['sort_order' => $i + 1, 'is_published' => true]
            );
        }
    }
}
