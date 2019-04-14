import ftplib

# Credentials imposés
user = ""
password = ""

bdd_host = "127.0.0.1"
bdd_user = "root"
bdd_pass = ""
bdd_name = "myctf"
# -----------------------------------------------
db = mysql.connector.connect(host=bdd_host, user=bdd_user, password=bdd_pass, database=bdd_name)
cursor = db.cursor()
input = db.cursor()

cursor.execute('SELECT id, urlServeur FROM groupe where isEnLigne = 1')
rows = cursor.fetchall()
for row in rows:
    nomServeur = row[1]
    print(nomServeur)
    try:
        # Connexion FTP standard
        ftplib.FTP(nomServeur, user, password)
    except ftplib.error_perm as ePerm:
        # Erreur sur les permissions...
        print("     en FTP => {}".format(ePerm))

        # Tentative de passage en TLS
        try:
            ftplib.FTP_TLS(nomServeur, user, password)
        except ftplib.error_perm as ePerm:
            # Erreur sur les permissions...
            print("     en TLS => {}".format(ePerm))
            pass
        except ftplib.all_errors as eGlobale:
            print("     ==> Connexion FTP & FTP TLS impossible - {]".format(eGlobale))
            pass
        pass
    except ftplib.all_errors as eGlobale:
        print("     ==> Erreur fatale : {}".format(eGlobale))
        pass

