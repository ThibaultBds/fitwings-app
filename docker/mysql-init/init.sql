CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'coach', 'moderateur', 'admin') DEFAULT 'user',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS temoignages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    note TINYINT NOT NULL,
    contenu TEXT NOT NULL,
    statut ENUM('en_attente', 'approuve', 'refuse') NOT NULL DEFAULT 'en_attente',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_temoignages_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE,
    CONSTRAINT chk_temoignages_note
        CHECK (note BETWEEN 1 AND 5)
);

CREATE TABLE IF NOT EXISTS candidatures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    poste VARCHAR(100),
    message TEXT,
    statut ENUM('recue', 'vue', 'rejetee', 'acceptee') NOT NULL DEFAULT 'recue',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS progression (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    poids DECIMAL(5,2) NOT NULL,
    tour_taille DECIMAL(5,2),
    nombre_seances INT NOT NULL DEFAULT 0,
    date_suivi DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS programme (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    niveau VARCHAR(50),
    objectif VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS programme_utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    programme_id INT NOT NULL,
    statut ENUM('en_cours', 'termine', 'abandonne') NOT NULL DEFAULT 'en_cours',
    CONSTRAINT fk_prog_user_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_prog_user_programme
        FOREIGN KEY (programme_id) REFERENCES programme(id)
        ON DELETE CASCADE,
    UNIQUE (user_id, programme_id)
);

CREATE TABLE IF NOT EXISTS coachs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT DEFAULT NULL,
    nom VARCHAR(100) NOT NULL,
    specialite VARCHAR(100),
    bio TEXT,
    photo VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS salle (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    adresse TEXT,
    ville VARCHAR(100),
    code_postal VARCHAR(10),
    telephone VARCHAR(20),
    email VARCHAR(255) UNIQUE,
    horaires VARCHAR(255),
    description TEXT
);