<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * 
         * php artisan make:model UserPermission
         * php artisan make:model UserProfile
         * php artisan make:model Employee
         * php artisan make:model EmployeeInfo
         * php artisan make:model EmployeeGovernmentAccount
         * php artisan make:model EmployeeResidential
         * php artisan make:model EmployeeFamilyBackground
         * php artisan make:model EmployeeEducationalBackground
         * php artisan make:model EmployeeCivilService
         * php artisan make:model EmployeeWorkExperience
         * php artisan make:model EmployeeVolunteer
         * php artisan make:model EmployeeTraining
         * php artisan make:model EmployeeHobbiesAndSkill
         * php artisan make:model EmployeeRecognition
         * php artisan make:model EmployeeOrganizationsOrAssociation
         * php artisan make:model EmployeeReference
         * php artisan make:model EmployeeGovernmentIssuedId
         * php artisan make:model QuestionIntro
         * php artisan make:model QuestionContent
         * php artisan make:model EmployeeQuestionAnswer
         * 
         */
        
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('info_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('user_permissions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('user_profiles', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->foreign('employee_file_id')->references('id')->on('employee_files')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('employee_infos', function (Blueprint $table) {
            $table->foreign('department_id')->references('id')->on('departments')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('academic_rank_id')->references('id')->on('academic_ranks')
                ->onDelete('cascade')->onUpdate('cascade');
                
            $table->foreign('employee_id')->references('id')->on('employees')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('employee_government_accounts', function (Blueprint $table) {
            $table->foreign('employee_id')->references('id')->on('employees')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('employee_residentials', function (Blueprint $table) {
            $table->foreign('employee_id')->references('id')->on('employees')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('employee_family_backgrounds', function (Blueprint $table) {
            $table->foreign('employee_id')->references('id')->on('employees')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('employee_educational_backgrounds', function (Blueprint $table) {
            $table->foreign('school_id')->references('id')->on('school_lists')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('employee_civil_services', function (Blueprint $table) {
            $table->foreign('career_service_id')->references('id')->on('career_services')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('employee_work_experiences', function (Blueprint $table) {
            $table->foreign('agency_or_company_id')->references('id')->on('agency_or_companies')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('employee_volunteers', function (Blueprint $table) {
            $table->foreign('agency_or_company_id')->references('id')->on('agency_or_companies')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('employee_trainings', function (Blueprint $table) {
            $table->foreign('agency_or_company_id')->references('id')->on('agency_or_companies')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('employee_hobbies_and_skills', function (Blueprint $table) {
            $table->foreign('employee_id')->references('id')->on('employees')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('employee_recognitions', function (Blueprint $table) {
            $table->foreign('employee_id')->references('id')->on('employees')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('employee_organizations_or_associations', function (Blueprint $table) {
            $table->foreign('employee_id')->references('id')->on('employees')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('employee_references', function (Blueprint $table) {
            $table->foreign('employee_id')->references('id')->on('employees')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('employee_government_issued_ids', function (Blueprint $table) {
            $table->foreign('employee_file_id')->references('id')->on('employee_files')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('question_intros', function (Blueprint $table) {
            $table->foreign('question_number_id')->references('id')->on('question_numbers')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('question_contents', function (Blueprint $table) {
            $table->foreign('question_intro_id')->references('id')->on('question_intros')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('employee_question_answers', function (Blueprint $table) {
            $table->foreign('question_content_id')->references('id')->on('question_contents')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')
                ->onDelete('cascade')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // 
        });

        Schema::table('user_permissions', function (Blueprint $table) {
            // 
        });

        Schema::table('user_profiles', function (Blueprint $table) {
            // 
        });

        Schema::table('employees', function (Blueprint $table) {
            // 
        });

        Schema::table('employee_infos', function (Blueprint $table) {
            // 
        });

        Schema::table('employee_government_accounts', function (Blueprint $table) {
            // 
        });

        Schema::table('employee_residentials', function (Blueprint $table) {
            // 
        });

        Schema::table('employee_family_backgrounds', function (Blueprint $table) {
            // 
        });

        Schema::table('employee_educational_backgrounds', function (Blueprint $table) {
            // 
        });

        Schema::table('employee_civil_services', function (Blueprint $table) {
            // 
        });

        Schema::table('employee_work_experiences', function (Blueprint $table) {
            // 
        });

        Schema::table('employee_volunteers', function (Blueprint $table) {
            // 
        });

        Schema::table('employee_trainings', function (Blueprint $table) {
            // 
        });

        Schema::table('employee_hobbies_and_skills', function (Blueprint $table) {
            // 
        });

        Schema::table('employee_recognitions', function (Blueprint $table) {
            // 
        });

        Schema::table('employee_organizations_or_associations', function (Blueprint $table) {
            // 
        });

        Schema::table('employee_references', function (Blueprint $table) {
            // 
        });

        Schema::table('employee_government_issued_ids', function (Blueprint $table) {
            // 
        });

        Schema::table('question_intros', function (Blueprint $table) {
            // 
        });

        Schema::table('question_contents', function (Blueprint $table) {
            // 
        });

        Schema::table('employee_question_answers', function (Blueprint $table) {
            // 
        });
    }
}
