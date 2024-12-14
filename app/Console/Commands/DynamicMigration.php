<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class DynamicMigration extends Command
{
    protected $signature = 'make:dynamic-migration {table} {--fields=}';
    protected $description = 'Generate dynamic migration based on fields';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $tableName = $this->argument('table');
        $fields = json_decode($this->option('fields'), true);

        if (Schema::hasTable($tableName)) {
            $this->error("Table $tableName already exists.");
            return;
        }
        $camelCaseModel = ucfirst(convertToCamelCase($tableName));
        $migrationName = 'Create' . $camelCaseModel . 'Table';
        $migrationFileName = camelToSnake($migrationName);

//        $this->call('make:migration', [
//            'name' => $migrationName,
//            '--create' => $tableName,
//        ]);
        try {
            $migrationFile = database_path('migrations') . '/' . now()->format('Y_m_d_His') . "_$migrationFileName.php";
            $modelName = $camelCaseModel;
            if (substr($camelCaseModel, -3) == 'ies') {
                $modelName = substr($camelCaseModel, 0, strlen($camelCaseModel) - 3) . 'y';
            } elseif (substr($camelCaseModel, -1) == 's') {
                $modelName = substr($camelCaseModel, 0, strlen($camelCaseModel) - 1);
            }
            $modelFile = base_path('Modules') . '/Settings/Entities/' . "$modelName.php";

            $this->generateMigrationFile($migrationFile, $migrationName, $tableName, $fields);
            $this->info("Dynamic migration file created: $migrationFile" . PHP_EOL);

            $this->generateModelFile($modelFile, $modelName, $tableName);
            $this->info("Dynamic model file created: $modelFile" . PHP_EOL);
        } catch (\Exception $exception) {
            $this->info("Exception: " . $exception->getMessage() . PHP_EOL);
        }
    }

    private function generateMigrationFile($path, $class, $table, $fields)
    {
        $stub = file_get_contents(base_path('database/migrations/stubs/migration.create.stub'));

        // Replace placeholders in the migration stub
        $stub = str_replace('{{ class }}', $class, $stub);
        $stub = str_replace('{{ table }}', $table, $stub);
        $stub = str_replace('{{ fields }}', $this->generateFieldDefinitions($fields), $stub);

        file_put_contents($path, $stub);
    }

    private function generateModelFile($path, $class, $table)
    {
        $stub = file_get_contents(base_path('database/migrations/stubs/migration.model.stub'));

        // Replace placeholders in the migration stub
        $stub = str_replace('{{ class }}', $class, $stub);
        $stub = str_replace('{{ table }}', $table, $stub);

        file_put_contents($path, $stub);
    }

    private function generateFieldDefinitions($fields)
    {
        $definitions = '';
        foreach ($fields as $field => $type) {
            if (strstr($type,'-')) {
                $typeArr = explode('-',$type);
                $definitions .= "\$table->$typeArr[0]('$field',$typeArr[1]);\n            ";
            } else {
                $definitions .= "\$table->$type('$field');\n            ";
            }
        }

        return $definitions;
    }
}
