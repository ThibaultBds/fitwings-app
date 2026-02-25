CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'moderateur', 'admin') DEFAULT 'user',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS temoignages (
    id int AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    note INT CHECK (note BETWEEN 1 AND 5),
    contenu TEXT NOT NULL,
    statut ENUM('en_attente', 'approuve', 'refuse'),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
    
);

CREATE TABLE IF NOT EXISTS candidatures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    poste VARCHAR(100),
    message TEXT,
    statut ENUM('recue', 'vue', 'rejetee', 'acceptee') DEFAULT 'recue',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);