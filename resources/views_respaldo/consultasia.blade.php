//Como utilizar un pluck con mas informacion en laravel 9?   
$ProjectManagers = Employees::select(
            DB::raw("CONCAT(first_name,' ',last_name) AS name"),'id')
            ->where('designation', 1)
            ->pluck('name', 'id');




<!--DELIMITER-->Source: https://stackoverflow.com/questions/40132046














