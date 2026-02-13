/* Database aanmaken*/
CREATE database IF NOT EXISTS boeken_db;



/*Tabellen maken*/
CREATE table gebruikers(
    id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
    naam VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(150) NOT NULL UNIQUE,
    wachtwoord VARCHAR(255) NOT NULL,
    aangemaakt_op TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE table boeken(
	id int AUTO_INCREMENT NOT NULL PRIMARY KEY,
    titel VARCHAR(200) NOT NULL,
    auteur VARCHAR(150) NOT NULL,
    publicatiejaar int NOT NULL,
    genre varchar(100) NOT NULL,
    afbeelding VARCHAR(255) NULL,
    beschrijving VARCHAR(255)
);

CREATE table recensies(
	id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
    gebruiker_id int NOT NULL,
    boek_id int NOT NULL,
    beoordeling tinyint NOT NULL,
    tekst TEXT,
    aangemaakt_op TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (gebruiker_id) REFERENCES gebruikers(id),
    FOREIGN KEY (boek_id) REFERENCES boeken(id)
);


INSERT INTO gebruikers (naam, email, wachtwoord) VALUES
    ('Lindsey',   'lindsey@salome.nl',   'Welkom01!'),
    ('Giuliana',  'giuliana@salome.nl',  'Welkom02!'),
    ('Koosje',    'koosje@salome.nl',    'Woof03!'),
    ('Thomas',    'thomas@leesclub.nl',  'Boeken04!'),
    ('Nathalie',  'nathalie@lezen.nl',   'Pagina05!'),
    ('Daan',      'daan@boekenrak.nl',   'Verhaal06!'),
    ('Sofie',     'sofie@romans.nl',     'Fictie07!'),
    ('Ruben',     'ruben@bladeren.nl',   'Hoofdstuk08!'),
    ('Iris',      'iris@leeshoek.nl',    'Bladwijzer09!'),
    ('Pieter',    'pieter@boekenwurm.nl','Epiloog10!');


/* ─── BOEKEN ─────────────────────────────────── */
INSERT INTO boeken (titel, auteur, publicatiejaar, genre, afbeelding, beschrijving) VALUES
    (
        'Het ultieme geheim',
        'Dan Brown',
        2025,
        'Thriller',
        'het_ultieme_geheim.jpg',
        'Robert Langdon wordt midden in de nacht gewekt door een alarmerend telefoontje. Een wetenschapper is dood aangetroffen in het Vaticaan, en een geheime boodschap wijst naar een eeuwenoud complot dat de wereld op zijn grondvesten kan doen schudden. Langdon heeft 24 uur om de waarheid te achterhalen.'
    ),
    (
        'De hulp',
        'Freida McFadden',
        2025,
        'Thriller',
        'de_hulp.jpg',
        'Millie begint als huishoudster bij een welgesteld gezin in een chique wijk. Alles lijkt perfect – totdat ze begint te merken dat er iets niet klopt. Deuren die op slot gaan, fluisterende stemmen en een verleden dat niemand wil bespreken. Wie helpt hier eigenlijk wie?'
    ),
    (
        'Cozy & cute in de bakkerij',
        'Belly Bean Co.',
        2026,
        'Kinderen',
        'cozy_bakkerij.jpg',
        'Een heerlijk zoet kleurboek vol schattige dieren die werken in een gezellige bakkerij. Van knapperige croissants tot kleurrijke cupcakes – dit extra dikke papier is perfect voor kleurpotloden én stiften. Voor kinderen vanaf 6 jaar.'
    ),
    (
        'Het achterhuis',
        'Anne Frank',
        1947,
        'Biografie',
        'achterhuis.jpg',
        'Het dagboek van Anne Frank is een van de meest aangrijpende getuigenissen van de Tweede Wereldoorlog. Twee jaar lang schreef het Joodse meisje Anne Frank haar gedachten, dromen en angsten op terwijl ze zich met haar familie verstopte in een achterhuis in Amsterdam.'
    ),
    (
        'De Hobbit',
        'J.R.R. Tolkien',
        1937,
        'Fantasy',
        'hobbit.jpg',
        'Bilbo Balings is een rustige hobbit die het liefst thuis blijft – totdat de tovenaar Gandalf voor zijn deur staat. Al snel bevindt Bilbo zich midden in een groot avontuur, samen met dertien dwergen op weg naar de Eenzame Berg om de draak Smaug te verslaan.'
    );


/* ─── RECENSIES ──────────────────────────────── */

/* Het ultieme geheim (boek_id = 1) */
INSERT INTO recensies (gebruiker_id, boek_id, beoordeling, tekst) VALUES
    (3,  1, 1, 'woof woof kut boek, helemaal niks aan.'),
    (4,  1, 4, 'Typisch Dan Brown: ontzettend spannend en moeilijk neer te leggen. Het einde vond ik iets te voorspelbaar, maar verder een aanrader!'),
    (7,  1, 5, 'Ik heb hem in één weekend uitgelezen. Geweldige plot twists, echt zijn beste boek in jaren.'),
    (9,  1, 3, 'Leuk voor onderweg, maar de personages voelen wat vlak aan. De historische achtergrond vond ik wel interessant.');

/* De hulp (boek_id = 2) */
INSERT INTO recensies (gebruiker_id, boek_id, beoordeling, tekst) VALUES
    (1,  2, 4, 'Leuk boek maar ik heb betere gelezen. De spanning bouwt langzaam op maar het einde maakt veel goed.'),
    (3,  2, 5, 'woof woof leuk boek, kan niet stoppen met lezen!'),
    (5,  2, 5, 'McFadden weet hoe ze een lezer vast moet houden. Elke bladzijde wilde ik weten wat er verder ging. Absoluut aanrader!'),
    (8,  2, 4, 'Psychologisch slim opgebouwd. Soms een beetje traag in het midden, maar de ontknoping was verrassend goed.'),
    (10, 2, 2, 'Ik snapte niet goed waar het verhaal naartoe ging. Misschien niet het genre voor mij.');

/* Cozy & cute in de bakkerij (boek_id = 3) */
INSERT INTO recensies (gebruiker_id, boek_id, beoordeling, tekst) VALUES
    (2,  3, 5, 'Cozy en cute inderdaad! Mijn dochter van 7 is er helemaal gek op. Het papier is echt lekker dik.'),
    (6,  3, 5, 'Perfect cadeau voor mijn nichtje. Ze vindt de diertjes geweldig en de tekeningen zijn super schattig.'),
    (1,  3, 4, 'Heel leuk kleurboek, de afbeeldingen zijn gedetailleerd genoeg voor oudere kinderen maar ook niet te moeilijk.');

/* Het achterhuis (boek_id = 4) */
INSERT INTO recensies (gebruiker_id, boek_id, beoordeling, tekst) VALUES
    (4,  4, 5, 'Een onmisbaar boek. Ontroerend, moedig en tijdloos. Ik moest meerdere keren het boek wegleggen om even bij te komen.'),
    (5,  4, 5, 'Dit boek raakt je tot in het diepst van je ziel. Iedereen zou het moeten lezen, zeker de jongere generatie.'),
    (6,  4, 4, 'Indrukwekkend hoe Anne haar gevoelens zo helder kon opschrijven in zo''n moeilijke tijd. Een echte aanrader.'),
    (9,  4, 5, 'Het luisterboek voorgelezen door Carice van Houten is ook prachtig. Ze geeft Anne echt een stem.'),
    (2,  4, 4, 'Aangrijpend en leerzaam. We mogen nooit vergeten wat er in die periode is gebeurd.');

/* De Hobbit (boek_id = 5) */
INSERT INTO recensies (gebruiker_id, boek_id, beoordeling, tekst) VALUES
    (7,  5, 5, 'Een klassieker die nooit verveelt. De wereld van Midden-Aarde is zo rijk en gedetailleerd uitgewerkt. Tolkien is een meester.'),
    (8,  5, 5, 'Mijn favoriete fantasy boek ooit. De avonturen van Bilbo zijn zowel grappig als spannend. Onmisbaar!'),
    (10, 5, 4, 'Mooie opbouw en geweldige personages. Soms wat langzaam, maar dat past bij de stijl van Tolkien.'),
    (3,  5, 5, 'woof woof dit boek is GEWELDIG. Bilbo is mijn held!'),
    (1,  5, 3, 'Ik vind fantasy normaal niet zo mijn ding, maar De Hobbit was toch goed leesbaar. Zeker voor beginners in het genre.');
















