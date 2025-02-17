<?php

use App\Models\Author;
use App\Models\Category;
use App\Models\Source;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('url', 255)->unique()->index();
            $table->longText('image_url')->nullable();

            $table->foreignIdFor(Source::class, 'source_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignIdFor(Author::class, 'author_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignIdFor(Category::class, 'category_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->timestamp('published_at')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
