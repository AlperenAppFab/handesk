<?php

use App\TicketType;
use Illuminate\Database\Seeder;

class TicketTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ticketTypes = [
            'Testte Problem'           => '#ffa200',
            'Teknik Hata'              => '#ff0000',
            'Kredi Yüklemede Problem' => '#68ff00',
            'Diğer'                    => '#00f9ff',
        ];

        foreach ($ticketTypes as $name => $color) {
            TicketType::create([
                'name'  => $name,
                'color' => $color,
            ]);
        }
    }
}
