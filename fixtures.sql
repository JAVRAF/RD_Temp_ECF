INSERT INTO admin (id, username, roles, password)
VALUES (1, 'Admin', '[\"ROLE_ADMIN\"]', '$2y$10$THO/dPSleYlzziH7CXaJNOHWSH2We97e924QO.0kubIE5uJkPoVeG');

INSERT INTO store (id, username, roles, password, address, city, phone_number)
VALUES (1, 'OFF_par_1', '[\"ROLE_STORE\"]', '$2y$10$xdXs6dRAICK1.PGYCfU0EO/wtqe8OzJPrPiheRB3qlI.wr9zSdiJC',
        '15 rue des Lilas', 'Paris', '0123456789'),
       (2, 'OFF_iss_2', '[\"ROLE_STORE\"]', '$2y$10$FovIp1PXiM0pYGErdDMqhemg.LJwAEWrczYnCnfqWafywYi.pBZ4C',
        '15 avenue de la république', 'Issy-les-moulineaux', '0198765432'),
       (3, 'OFF_vil_3', '[\"ROLE_STORE\"]', '$2y$10$nZyFKt5xBHBVlGmaeuzhl./ApJ.0KWCTu0HogcCxYCgZaNZvu6Bki',
        '20 rue Varappe', 'Villejuif', '0147852369');

INSERT INTO tech (id, username, roles, password)
VALUES (1, 'Tech01', '[\"ROLE_TECH\"]', '$2y$10$Q/Ul66qDNrJse.DgzpuqdOTeyXes1InmOLceECkh.ZpeecMh2A58y'),
       (2, 'Tech02', '[\"ROLE_TECH\"]', '$2y$10$Ls6XggLUTRfXKGN5SK0H1eg.zWYcYbIY0meVvHWZAj6wXOKv6m6x2');

INSERT INTO cooling_chamber (id, store_id, name, temp_probe, hygro_probe)
VALUES (1, 1, 'vaccin_1', 'CC-TP01', 'CC-HP01'),
       (2, 1, 'vaccin_2', 'CC2-TP01', 'CC2-HP01'),
       (3, 2, 'Antibio_1', 'CC3-TP01', 'CC3-HP01'),
       (4, 3, 'CF_1', 'CC4-TP01', 'CC4-HP01'),
       (5, 3, 'CF_2', 'CC5-TP01', 'CC5-HP01'),
       (6, 3, 'CF_3', 'CC6-TP01', 'CC6-HP01'),
       (7, 2, 'Chambre_froide', 'CC7-TP01', 'CC7-HP01');
