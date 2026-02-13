<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Service;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $services = [
            'Family Therapy' => "Improving communication and emotional expression\nResolving conflicts constructively\nStrengthening family support systems\nCreating healthier boundaries and roles",
            'Individual Therapy' => "Increasing self-awareness and emotional regulation\nManaging stress, anxiety, or low mood\nBuilding confidence and decision-making skills\nPromoting healing and personal development",
            'Couple Therapy' => "Enhancing communication and empathy\nResolving conflicts in healthy ways\nRebuilding trust and emotional closeness\nStrengthening partnership and mutual support",
        ];

        foreach ($services as $title => $goals) {
            Service::where('title', 'LIKE', $title . '%')->update(['goals' => $goals]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Service::query()->update(['goals' => null]);
    }
};
