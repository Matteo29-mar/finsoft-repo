# ITS-STG23: Progetto GreenField
### Tecnologie
- HTML, CSS, JavaScript, PHP
- Apache o NGINX
- MySQL

---
# Descrizione del progetto
## Livelli di autenticazione (2):

-  **Privato** - nessun tipo di login necessario
-  **Aziendale** - Registrazione/login obbligatori: ricevitrice delle richieste di valutazione
-  **Administrator** - Login obbligatorio: gestore portale

---

## In cosa consiste la WebApp
-  **Livello Privato** (non autenticato)

Il privato che si collega al sito web avrà la possibilità di aprire una nuova richiesta di valutazione: per completare la procedura di richiesta dovrà caricare una o più immagini in formato JPG o PNG non più grandi di 2MB raffiguranti il prodotto che vuole che gli venga valutato.

Il privato che intende fare una richiesta di valutazione  insieme all'upload del punto 1 dovrà riempire una serie di campi (nome, cognome, mail(regex), numero di telefono)

Una volta completata la procedura, la richiesta con tutte le informazioni ricevute in input verrà salvata in una tabella dedicata per l'amministazione.

Una volta premuto il pulsante invia, in contemporanea con il salvataggio dei dati a db, dovrà partire una mail per tutte le aziende registrate.

---
-  **Livello Aziendale**

In una pagina a se stante composta da una serie di input form permetterà la registrazione delle aziende.

I campi necessari sono: Id(autoincrementale) Ragione sociale (nome azienda), PVIA, CodiceFiscale, Nome e Cognome del responsabile, numero di telefono, mail responsabile, indirizzo azienda.

I dati ricevuti verranno salvati su una tabella dedicata chiamata "aziende". Inoltre, dovranno essere aggiunti 2 campi in più, abilitato, cancellato.

Il campo abilitato al momento dell'iscrizione sarà flaggato a false (boolean) e il campo "cancellato" altretanto.

Sarà l'amministratore che dopo aver valutato i dati inseriti deciderà se abilitare l'azienda flaggando a true il campo.

Se l'amministrato decide di abilitare l'azienda, dovrà partire una mail che avvisa il candidato dell'avvenuta abilitazione.

A questo punto, l'azienda avrà la possibilita di accedere tramite login alla propria pagina dove ci saranno tutte le proposte ricevute e valutate.

I dati di login verranno salvati su una tabella a parte, che conterra, PIVA e password (sha512), la password verrà generata automaticamente e verrà comunicata in chiaro via mail.

L'azienda che si collega al portale dovrà effettuare il login, dopo aver effettuato correttamente il login avrà la possibilità di vedere tutte le richieste caricate da tutti i privati.

---
-  **Livello Amministrazione**
L'amministratore è il "gestore del software" ha accesso e visibilità su tutto. Gli account di Amministrazione possono essere al massimo 2.

L'ammministratore che si collega al portale dovrà effettuare il login nella stessa area per tutti i livelli di accesso. 

Avrà la possibilità di vedere tutte le richieste di valutazione presenti con la possibilità di eliminare, modificare. 

Dovrà inoltre, vedere una sezione con tutte le aziende registrate al portale, sarà in questa vista dove potrà decidere se abilitare o meno l'azienda.

Tutte le utenze sono modificabili (nome, cognome, email, account attivo o bloccato, ecc..) o eliminabili dall'amministratore.


## Architecture

![Architecture](https://github.com/finsoftsrl/ITS-STG23/blob/master/immagini/ITS-STG23.png?raw=true)
