<p align="center">
<img src="https://maxon.id/assets/img/logo-maxon.png" width="300" alt="Maxon Prime">
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="200" alt="Laravel Logo"></p>


## Server Requirement

- PHP >= 8.2
- MYSQL >= 5.7
- SSH Access
- Composer
- NPM 

## Note (Structure)
- setiap perubahan pada database (baik itu table, field, fixed value/konstant value), harap menggunakan migration
- gunakan prefix master_ untuk tabel master data
- jika ada tabel yang jenis transaksi berelasi gunakan prefix dari tabel utama
- contoh : 
    ```
        master_types 
        products
        product_types
    ```
- Setiap modul dibuatkan folder baik di controller, model, dan view
- contoh :
    ```
        Modul : Master Department
        Migration : create_master_departments
        Model : Master\Department
        Controller : Admin\Master\DepartmentController
        View : resources/views/admin/master/department/
    ```
- Route (routes/) setiap modul dikelompokkan berdasarkan jenis
- penamaan route : role.jenis.modul.action, 
- contoh : 
    ```
        admin.master.department.view 
        admin.master.department.create
        admin.master.department.update
        admin.master.department.delete
    ```

## Install

- Step for development run :
``` bash
    $ cp .env.example .env
    $ composer install  
    $ composer dump-autoload  
    $ php artisan key:generate  
    $ php artisan migrate:fresh --seed    
    $ php artisan storage:link  
```
