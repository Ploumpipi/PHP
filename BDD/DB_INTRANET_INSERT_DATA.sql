insert into Utilisateurs(id_utilisateur, Nom, Prénom, Pseudo, mdp, rang) VALUES
(1, "Pochard", "Alexandre", "Tanche", 0000, "Élève"),
(2, "Gredin", "Maxime", "Massif", 1111, "Élève"),
(3, "Laroche", "Pierre", "Caillou", 2222, "Élève"),
(4, "Mini", "Boo", "Gpeur", 3333, "Élève"),
(500, "Kenway", "Edouard", "Gliboub", 0000, "Prof"),
(501, "Astro", "Logie", "Espace", 1111, "Prof"),
(502, "Path", "Finder", "Find", 2222, "Prof"),
(503, "Pat", "Acaisse", "Lourd", 3333, "Prof");

insert into listeNote(id_note, matiere_test, valeur, id_etudiant, id_prof) VALUES
(1, "Français", 12, 3, 1),
(2, "Français", 15, 2, 1),
(3, "Anglais", 12, 2, 2);