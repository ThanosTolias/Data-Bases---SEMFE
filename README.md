# Βάσεις Δεδομένων ΣΕΜΦΕ
Εξαμηνιαία Εργασία για το μάθημα "Βάσεις Δεδομένων" κατά το εαρινό εξάμηνο του ακαδημαικού έτους 2021 - 2022.

### Συμμετέχοντες
- Καμηλούδης Ιωάννης - Παναγιώτης (ge18020)
- Κλιάφας Στυλιανός (ge14053)
- Τόλιας Αθανάσιος (ge18033)

### Οδηγίες Εγκατάστασης Εφαρμογής (για Windows)
***1.*** Κατεβάστε το XAMPP από αυτόν τον [σύνδεσμο](https://www.apachefriends.org/index.html) και εκτελέστε την εγκατάσταση του. <br>
**Προσοχή**: Βεβαιωθείτε ότι η εγκατάσταση θα γίνει μέσα στην τοποθεσία: C:\xampp. Επίσης, κατά την διάρκεια της εγκατάστασης (στο παράθυρο Select Components) πρέπει να επιλέξετε προς εγκατάσταση τουλάχιστον τα εξής: Apache, MySQL και PHP.

***2.*** Μόλις ολοκληρωθεί η εγκατάσταση, εκτελέστε το XAMPP Control Panel σαν administrator. Ξεκινήστε τις services Apache και MySQL επιλέγοντας το κουμπί Start και για τις δύο services.

***3.*** Κάντε κλικ [εδώ](https://github.com/ThanosTolias/Data-Bases---SEMFE/archive/refs/heads/main.zip) έτσι ωστε κατεβαίνουν όλα τα απαραίτητα files.

***4.*** Κάντε extract το προηγούμενο zip αρχείο σε κάποιο φάκελο της επιλογής σας. Τώρα, καλείστε να αντιγράψετε τον φάκελο Front\_Back-End\_Stuff (που μόλις δημιουργήθηκε) στην τοποθεσία C:xampp\htdocs. Αλλάξτε το όνομα του φακέλου Front\_Back-End\_Stuff που μόλις αντιγράψατε σε dbproject.

***5.*** Ανοίξτε ένα terminal (shell) πατώντας το κουμπί Shell στο XAMPP Control Panel. Με εντολές "cd" (change directory) καταλήξτε στο directory που κάνατε extract το zip αρχείο. **Για παράδειγμα**, αν έχετε κάνει extract το zip αρχείο στον φάκελο Downloads τότε πληκτρολογήστε:
```sh
cd C:\Users\!username!\Downloads\Data-Bases---SEMFE-main
```
όπου !username!: το όνομα του λογαριασμού στον υπολογιστή σας

***6.***  Πληκτρολογήστε στο ίδιο shell:
```sh
mysql -u root -p
```
και πατήστε enter. Θα σας ζητηθεί ένας κωδικός. Αν έχετε βάλει κωδικό κατά την διάρκεια της εγκατάστασης του XAMPP πληκτρολογήστε τον κωδικό σας και πατήστε ξανά enter. Αν όχι (default επιλογή), πατήστε απλά enter.

***7.***  Τρέξτε τα παρακάτω commands στο παραπάνω shell με την σειρα που δίνονται:
```sh
source fakelos\create_tables.sql
source fakelos\indexes.sql
source fakelos\triggers.sql
source fakelos\insert_data.sql
```
***8.*** Ανοίξτε τον web browser της επιλογής σας και πληκτρολογήστε την διεύθυνση [http://localhost/dbproject/](http://localhost/dashboard/) (ή [http://127.0.0.1/dbproject/](http://127.0.0.1/dbproject/)).
Σε περίπτωση που δεν ανοίγει η σελίδα, βεβαιωθείτε ότι ο Apache τρέχει στην port 80 (default) κοιτάζοντας το μέσα από το XAMPP Control Panel. Αν όχι, πληκτρολογήστε στον web browser σας την διεύθυνση:
localhost:"newport"/dbproject (ή 127.0.0.1:"newport"/dbproject)
όπου "newport" είναι η port που τρέχει ο Apache (όπως εντοπίσατε από το XAMPP Control Panel).

**Σημείωση**: Αν έχετε βάλει κωδικό στην mysql, ανοίξτε το αρχείο C:\xampp\htdocs\dbproject\db_connection.php με κάποιον editor της επιλογής σας και στην μεταβλητή $dbpass πληκτρολογήστε τον κωδικό σας.
