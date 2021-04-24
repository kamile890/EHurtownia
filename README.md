1. Pierwsze co to trzeba stworzyć bazę danych
2. Nazwa bazy danych znajduje się w pliku .env - 13 linia(teraz jest ustawione na "amazon")
3. W terminalu wpisujemy "php artisan migrate" - bez błędów powinno stworzyć tabele w bazie danych
4. Wpisujemy "php artisan db:seed --class=RoleSeeder" - tabela "roles" wypełnia się danymi
5. Wpisujemy "php artisan db:seed --class=UserSeeder" - w tabeli users tworzony jest administrator (email: admin@gmail.com, hasło: admin)




