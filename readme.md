 📚 Bladwijzer — Boeken recensie website

Een website waar gebruikers boeken kunnen bekijken en recensies kunnen lezen en schrijven.
Gebouwd met PHP, MySQL, HTML en CSS.

---

## ⚙️ Installatie

1. Zet de projectmap in je `htdocs` of `www` map (XAMPP/WAMP)
2. Importeer `boeken.sql` in phpMyAdmin om de database aan te maken
3. Pas de databasegegevens aan in `includes/db.php` als dat nodig is
4. Open `http://localhost/projectnaam` in je browser

### Standaard databasegegevens (`includes/db.php`)
| Instelling | Waarde |
|---|---|
| Host | localhost |
| Gebruiker | bit_academy |
| Wachtwoord | bit_academy |
| Database | boeken_db |

---

## 📁 Mappenstructuur

```
project/
│
├── includes/
│   ├── db.php              # Databaseverbinding
│   ├── formhandler.inc.php # Verwerkt nieuwe recensie
│   ├── update.php          # Verwerkt bewerkte recensie
│   └── delete.php          # Verwijdert een recensie
│
├── img/
│   └── bk_cover/           # Boekomslagen (.jpg)
│
├── index.php               # Overzicht van alle boeken
├── boek_info.php           # Detailpagina van één boek
├── maak_recensie.php       # Formulier: recensie schrijven
├── edit_recensie.php       # Formulier: recensie bewerken
├── style.css               # Alle opmaak
└── boeken.sql              # Database structuur + voorbeelddata
```

---

## 💡 Functionaliteiten

- Overzicht van alle boeken met gemiddelde beoordeling
- Detailpagina per boek met alle recensies
- Recensie schrijven (gebruiker kiezen uit dropdown)
- Recensie bewerken en verwijderen