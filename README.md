
# 🧠 SpeakWell – Applicazione Yii2 con Docker

Questo progetto è una piattaforma per logopedisti, caregiver e assistiti, sviluppata con Yii2 e containerizzata tramite Docker.

---

## 🚀 Requisiti

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
- File `speakwell.sql` con il dump del database MySQL (già incluso o fornito separatamente)

---

## 📦 Installazione

1. **Clona il progetto o scaricalo**

   ```bash
   git clone https://github.com/tuo-utente/speakwell.git
   cd speakwell
   ```

2. **Assicurati di avere il file `speakwell.sql` nella cartella di progetto**

3. **Avvia Docker Desktop**

   Assicurati che **Docker sia in esecuzione** prima di continuare.

4. **Costruisci ed esegui i container**

   ```bash
   docker-compose up --build -d
   ```

5. **Importa il database MySQL**

   Copia il file SQL nel container:

   ```bash
   docker cp speakwell.sql yii_db:/speakwell.sql
   ```

   Poi entra nel container e importa:

   ```bash
   docker exec -it yii_db bash
   mysql -u root -p
   # password: root
   mysql> SOURCE /speakwell.sql;
   mysql> exit;
   exit
   ```

6. **Accedi all'app**

   Apri il browser su:

   ```
   http://localhost:8080
   ```

---

## ⚙️ Configurazione Yii2

La configurazione del DB si trova in `config/db.php`:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=db;port=3306;dbname=speakwell',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
];
```

---

## 📁 Upload file

I file caricati (immagini/audio) vengono salvati nella cartella `uploads/`.  
All'interno del container viene creata automaticamente in `/var/www/html/uploads`.

---

## 🛠 Comandi utili

- Riavvia i container:

  ```bash
  docker-compose restart
  ```

- Visualizza log dei container:

  ```bash
  docker-compose logs
  ```

- Entra nel container PHP:

  ```bash
  docker exec -it yii_app bash
  ```

---

## 👤 Accesso (esempio)

Se hai account logopedisti o caregiver già nel database, puoi accedere dal form di login.  
Altrimenti crea nuovi utenti tramite interfaccia.

---

## 🤝 Autori

- 👨‍💻 Sviluppato da: *[Il tuo nome o gruppo di lavoro]*
- 📚 Università: *Ingegneria del Software – Università del Salento*

---

## 📄 Licenza

MIT / uso didattico
