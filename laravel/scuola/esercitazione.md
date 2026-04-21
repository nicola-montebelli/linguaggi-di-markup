#1 Creare un progetto: composer create-project laravel/laravel scuola
#2 configuriamo il file .env  (log_stack= daily | tutta la parte database | key generate ma dovrebbe farla all'inizio del progetto)
#3 creiamo il database con: php artisan migrate
#4 creiamo il file api nella cartella routes con: php artisan install:api
#5 creiamo la tabella con php artisan make:migration create_studenti_table
#6 nella cartella migrations editare il file riguardante la tabella studenti (...create_studenti_table) aggiungendo i campi che ci interessano
#6-A php artisan migrate
#7 creiamo un seeder con php artisan make:seeder StudentSeeder , apriamolo e popoliamolo con alcuni esempi di studenti
#8 per inserire quei valori nel db facciamo php artisan db:seed StudentSeeder
#(per alcuni errori sono stati cambiate alcune cose: nome della tabella da studenti a students | lunghezza del campo email da 20 a 200 e il nome da mail a email)
#9 creiamo il controller con: php artisan make:controller StudentController --api (--api creerà tutti i metodi automaticamente)
#10 definiamo le query in ogni metodo
#11 nel file api richiamiamo le api Route::apiResource('students'\App\Http\Controllers\StudentController::class);
#per attivare il server usare php artisan serve
#12 aggiungere nel modello User HasApiToken in modo da poter creare i personal_access_token
#13 definiamo la parte di codice in cui dato un utente validato creaimo un token
#(file api riga 18-32)
#13 andiamo in tinker con php artisan tinker
#14 creiamo un User con: User::create(['email' => 'admin@example.com', 'name'=> 'admin', 'password' => Hash::make('password123')]);
#15 in postman dobbiamo fare una chiamata post in cui nel body inseriamo mail e name
#16 ora creiamo un model con: php artisan make:model Vote -mcr 
questo creerà una nuova migration che dovremo popolare con dei campi 
#17 php artisan migrate
#18 dentro Http\Models troviamo Vote
il model è uguale alla tabella (è il modello di una tabella)
#con il model definiamo le relazioni tra tabelle
in questo caso 1:n perchè gli studenti hanno molti voti ma i voti appartengono a un solo utente
#19 con php artisan tinker possiamo testare le ricerche: App\Models\Student::with(['votes'])->get() 
#20 nel controller StudentController abbiamo cambiato le chiamate in modo da usare il Modello
