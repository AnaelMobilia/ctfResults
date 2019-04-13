#!/bin/python
import subprocess
import mysql.connector
import time

urls = ('', 'dev.', 'git.', 'www.')
bdd_host = "127.0.0.1"
bdd_user = "root"
bdd_pass = ""
bdd_name = "myctf"
# -----------------------------------------------
def ping(url):
    reponse = subprocess.run('ping -c 1 ' + url, shell=True, stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL)
    return reponse.returncode

db = mysql.connector.connect(host=bdd_host, user=bdd_user, password=bdd_pass, database=bdd_name)
cursor = db.cursor()
input = db.cursor()

# Partie 1 : On balance les pings
cursor.execute('SELECT id, urlServeur FROM groupe where isEnLigne = 1')
rows = cursor.fetchall()
for row in rows:
    for url in urls:
        serveur = url + row[1]
        reponse = ping(serveur)
        print("ping {} - reponse : {}".format(serveur, reponse))
        input.execute('INSERT INTO ping (machine_id, url, reponse) VALUES (%s, %s, %s)', (row[0], serveur, reponse))

        # Partie 2 : on met une pénalité si 2 pings raté consécutifs
        if reponse != 0:
            input.execute('SELECT reponse from ping where machine_id = %s order by dateheure desc limit 1', (row[0], ))
            memo = input.fetchone()
            if memo[0] != 0:
                input.execute('INSERT INTO evenement (timestamp, type, etat, groupe, ip, tiers) VALUES (%s, 7, 1, %s, "127.0.0.1", %s)', (time.time(), row[0], row[0]))

db.commit()

