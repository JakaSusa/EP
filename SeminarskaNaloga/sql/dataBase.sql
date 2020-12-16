use mydb;

DELETE FROM administrator;
INSERT INTO administrator (admin_id, name, surname, email, password) VALUES
(1, 'admin', 'adm', 'admin.adm@store.com', 'password');



DELETE FROM prodajalec ;
INSERT INTO prodajalec (prodajalec_id, name, surname, email, password, status_status_id) VALUES
(1, 'Janez', 'Prodajalec', 'janez.prodajalec@store.com', 'password',
(SELECT status_id FROM status WHERE name = 'aktiven'));

DELETE FROM stranka;
INSERT INTO stranka (name, surname, email, password, naslov_postNum, status_status_id, street) VALUES
('Janez','Novak', 'janez.novak@gmail.com', 'password', 1000, 1, 'Dunajska 100'),
('Marija','Novak', 'marija.novak@gmail.com', 'password', 1000, 1, 'Dunajska 15');

DELETE FROM produkt;
INSERT INTO `produkt` (`product_id`, `name`, `price`, `describtion`, `status_status_id`) VALUES
(1, 'produkt1', 100, 'produkt stevilka ena', 1),
(2, 'produkt2', 10, 'produkt stevilka stiri', 1),
(3, 'produkt3', 150, 'produkt stevilka tri', 1),
(4, 'produkt4', 1000, 'produkt stevilka dva', 1);
