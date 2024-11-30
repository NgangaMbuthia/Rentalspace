<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoredReportProcudure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       $procedure = "
    CREATE PROCEDURE `Generate_reports`()
    BEGIN
    SET @SQL = NULL;
    SELECT
      GROUP_CONCAT(DISTINCT
        CONCAT(
          'sum(case when ic.name = ''',
          dt,
          ''' then p.amount else 0 end) AS `',
          dt, '`'
        )
      ) INTO @SQL
    FROM
    (
      SELECT ic.name AS dt,ic.code
      FROM invoice_componets ic
      ORDER BY ic.code
    ) d;
   
    SET @SQL
      = CONCAT('SELECT pr.title as Property,p.year as YEAR,p.month as MONTH,s.number,u.name,u.username, ', @SQL, ',sum(p.amount) As Total
                from invoice_componets ic INNER
            JOIN payments p  ON ic.id = p.charge_id
            JOIN tenants t  ON t.id = p.tenant_id
            JOIN spaces s on s.id=p.space_id
            JOIN properties pr on pr.id=s.property_id
            JOIN users u  ON u.id = t.user_id
           
         
            GROUP BY pr.title,p.year,p.month,s.number,u.name,u.username;');
                           
 
    PREPARE stmt FROM @SQL;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
         
    END
";

DB::unprepared("DROP procedure IF EXISTS procedure_name");
DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
