--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `name`, `surname`, `adress`, `region`, `city`, `phone`, `hours_credit`, `hours_debit`) VALUES
(1, 'jdupont35', 'jdupont35', 'jdupont35@fondationface.org', 'jdupont35@fondationface.org', 1, NULL, '$2y$13$7FHRT6ZLyg/X2IILNHz1tOnsTJzI6RGCzz/nOeGfpXWkqde.4UQv6', '2016-12-08 09:51:06', NULL, NULL, 'a:0:{}', 'Jean', 'Dupont', '23, rue d’Aiguillon\r\n35000 Rennes', 'Bretagne', 'Rennes', '0612244896', 20, 10),
(2, 'educlos', 'educlos', 'educlos@fondationface.org', 'educlos@fondationface.org', 1, NULL, '$2y$13$BZr2rMS8hqWzwEt4amO2n.mUs41tYjBWSqiE9InB6vgU8lmeVo822', '2016-12-08 09:53:29', NULL, NULL, 'a:0:{}', 'Erwann', 'Duclos', '17, allée des Acacias\r\n22440 Ploufragan', 'Bretagne', 'Ploufragan', '0408163264', 20, 5),
(3, 'massacor', 'massacor', 'amenager@fondationface.org', 'amenager@fondationface.org', 1, NULL, '$2y$13$vTWM6asSrHBdx4MY9tAMB.d9uIdwF3wmTkEwi5NGCDBOIk8CFUsM.', '2016-12-08 09:55:51', NULL, NULL, 'a:0:{}', 'Ange', 'Ménager', '42, place de la Liberté\r\n75000 Paris', 'Île de France', 'Paris', NULL, 5, 0);
