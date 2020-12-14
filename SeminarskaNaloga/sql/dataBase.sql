use mydb;
DELETE FROM produkt;
INSERT INTO `produkt` (`product_id`, `name`, `price`, `describtion`, `status`) VALUES
(1, 'produkt1', 100, 'produkt stevilka ena', 'aktiven'),
(2, 'produkt2', 10, 'produkt stevilka stiri', 'aktiven'),
(3, 'produkt3', 150, 'produkt stevilka tri', 'aktiven'),
(4, 'produkt4', 1000, 'produkt stevilka dva', 'aktiven');