CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  mot_de_passe_hash VARCHAR(255) NOT NULL,
  role ENUM('user','admin') NOT NULL DEFAULT 'user',
  date_inscription DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE artiste (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(150) NOT NULL UNIQUE,
  bio TEXT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE categorie (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL UNIQUE,
  description TEXT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE musique (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titre VARCHAR(200) NOT NULL,
  artiste_id INT NOT NULL,
  categorie_id INT NOT NULL,
  prix DECIMAL(10,2) NOT NULL,
  duree INT NULL,
  chemin_fichier VARCHAR(500) NOT NULL,
  chemin_extrait VARCHAR(500) NULL,
  date_publication DATE NULL,
  actif BOOLEAN NOT NULL DEFAULT TRUE,
  CONSTRAINT fk_musique_artiste FOREIGN KEY (artiste_id) REFERENCES artiste(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT fk_musique_categorie FOREIGN KEY (categorie_id) REFERENCES categorie(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  INDEX idx_musique_artiste (artiste_id),
  INDEX idx_musique_categorie (categorie_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE panier (
  id INT AUTO_INCREMENT PRIMARY KEY,
  utilisateur_id INT NOT NULL,
  date_creation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  statut ENUM('actif','converti','abandonne') NOT NULL DEFAULT 'actif',
  CONSTRAINT fk_panier_utilisateur FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id) ON DELETE CASCADE ON UPDATE CASCADE,
  INDEX idx_panier_user_statut (utilisateur_id, statut)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE panier_item (
  panier_id INT NOT NULL,
  musique_id INT NOT NULL,
  quantite INT NOT NULL DEFAULT 1 CHECK (quantite >= 1),
  prix_unitaire DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (panier_id, musique_id),
  CONSTRAINT fk_pi_panier FOREIGN KEY (panier_id) REFERENCES panier(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_pi_musique FOREIGN KEY (musique_id) REFERENCES musique(id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE commande (
  id INT AUTO_INCREMENT PRIMARY KEY,
  utilisateur_id INT NOT NULL,
  date_commande DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  total DECIMAL(10,2) NOT NULL,
  statut ENUM('payee','remboursee','annulee') NOT NULL DEFAULT 'payee',
  reference VARCHAR(64) NOT NULL UNIQUE,
  CONSTRAINT fk_commande_utilisateur FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id) ON DELETE CASCADE ON UPDATE CASCADE,
  INDEX idx_commande_user_date (utilisateur_id, date_commande)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE commande_item (
  commande_id INT NOT NULL,
  musique_id INT NOT NULL,
  quantite INT NOT NULL DEFAULT 1 CHECK (quantite >= 1),
  prix_unitaire DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (commande_id, musique_id),
  CONSTRAINT fk_ci_commande FOREIGN KEY (commande_id) REFERENCES commande(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_ci_musique FOREIGN KEY (musique_id) REFERENCES musique(id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
