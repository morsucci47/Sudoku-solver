CREATE TABLE sudoku_schemi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    livello VARCHAR(20),       -- facile, medio, difficile
    schema_iniziale CHAR(81),  -- lo schema con i buchi
    soluzione CHAR(81),        -- la soluzione completa
    data_creazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE schemi_sudoku ADD COLUMN nome VARCHAR(100) NOT NULL AFTER id;