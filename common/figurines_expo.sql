-- Créer la base de données
CREATE DATABASE IF NOT EXISTS expo_figurines;
USE expo_figurines;


-- Table des vendeurs
CREATE TABLE vendeurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    mail VARCHAR(100) NOT NULL UNIQUE,
    boutique VARCHAR(100) NOT NULL,
    pays VARCHAR(100) NOT NULL,
    date_inscription DATE NOT NULL
);

-- Table des figurines exposées
CREATE TABLE figurines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    licence VARCHAR(100) NOT NULL, -- ex: One Piece, Marvel, Dragon Ball
    materiau VARCHAR(100) NOT NULL,
    hauteur_cm DECIMAL(5,2) NOT NULL,
    description TEXT NOT NULL,
    vendeur_id INT NOT NULL,
    date_ajout DATE NOT NULL,
    FOREIGN KEY (vendeur_id) REFERENCES vendeurs(id)
);

-- Table des estimations de valeur des figurines
CREATE TABLE valeur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    figurine_id INT NOT NULL,
    prix_achat DECIMAL(10,2) NOT NULL,
    prix_estime DECIMAL(10,2) NOT NULL,
    etat ENUM('Neuf', 'Très bon état', 'Bon état', 'Occasion') NOT NULL,
    date_estimation DATE NOT NULL,
    FOREIGN KEY (figurine_id) REFERENCES figurines(id)
);

-- Table des utilisateurs administrateurs
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    droits ENUM('lecteur', 'editeur', 'admin') DEFAULT 'lecteur'
);



-- Insertion des vendeurs
INSERT INTO vendeurs (nom, prenom, mail, boutique, pays, date_inscription) VALUES
('Leroy', 'Marc', 'marc.leroy@example.com', 'CollectorFig', 'France', '2023-02-10'),
('Nguyen', 'Linh', 'linh.nguyen@example.com', 'OtakuTreasures', 'Belgique', '2023-05-14'),
('Fontaine', 'Sophie', 'sophie.fontaine@example.com', 'FigureLand', 'Suisse', '2024-01-20');

-- Insertion des figurines
INSERT INTO figurines (nom, licence, materiau, hauteur_cm, description, vendeur_id, date_ajout) VALUES
('Monkey D. Luffy - Gear 5', 'One Piece', 'PVC', 28.50, 'Figurine haut de gamme représentant Luffy en transformation Gear 5, peinture détaillée et socle lumineux.', 1, '2024-03-05'),
('Goku Ultra Instinct', 'Dragon Ball Z', 'Résine', 32.00, 'Statuette en résine limitée représentant Goku en Ultra Instinct, finition mate premium.', 2, '2024-04-12'),
('Iron Man Mark 85', 'Marvel', 'PVC', 25.00, 'Figurine articulée d\'Iron Man avec effets lumineux LED intégrés au réacteur.', 3, '2024-05-18'),
('Nezuko Kamado', 'Demon Slayer', 'PVC', 22.00, 'Figurine de Nezuko en pose de combat, détails du kimono peints à la main.', 1, '2024-06-01');

-- Insertion des valeurs
INSERT INTO valeur (figurine_id, prix_achat, prix_estime, etat, date_estimation) VALUES
(1, 180.00, 250.00, 'Neuf', '2024-03-06'),
(2, 220.00, 310.00, 'Neuf', '2024-04-13'),
(3, 150.00, 190.00, 'Très bon état', '2024-05-19'),
(4, 95.00, 130.00, 'Neuf', '2024-06-02');

-- Insertion des administrateurs
INSERT INTO admins (login, password_hash, droits) VALUES
('admin1', MD5('admin123'), 'admin'),
('editeur1', MD5('editeur123'), 'editeur'),
('lecteur1', MD5('lecteur123'), 'lecteur');
