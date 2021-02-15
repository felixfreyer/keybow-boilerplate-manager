-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Erstellungszeit: 15. Feb 2021 um 20:06
-- Server-Version: 5.7.26
-- PHP-Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `boilerplates`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `boilerplates`
--

CREATE TABLE `boilerplates` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sorting` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `boilerplates`
--

INSERT INTO `boilerplates` (`id`, `category`, `name`, `code`, `sorting`) VALUES
(1, 'php', 'php a', 'php 1', 1),
(2, 'php', 'php b', 'php 2', 2),
(3, 'php', 'php c', 'php 3', 3),
(4, 'js', 'js a', 'js 1', 1),
(5, 'js', 'js b', 'js 2', 2),
(6, 'js', 'js c', 'js 3', 3),
(7, 'html', 'BS Grid', '<div class=\"row\">\n    <div class=\"col-sm\">\n    </div>\n    <div class=\"col-sm\">\n    </div>\n    <div class=\"col-sm\">\n    </div>\n</div>', 1),
(8, 'html', 'BS Table', '<table class=\"table\">\n  <thead>\n    <tr>\n      <th scope=\"col\">#</th>\n      <th scope=\"col\">First</th>\n      <th scope=\"col\">Last</th>\n      <th scope=\"col\">Handle</th>\n    </tr>\n  </thead>\n  <tbody>\n    <tr>\n      <th scope=\"row\">1</th>\n      <td>Mark</td>\n      <td>Otto</td>\n      <td>@mdo</td>\n    </tr>\n    <tr>\n      <th scope=\"row\">2</th>\n      <td>Jacob</td>\n      <td>Thornton</td>\n      <td>@fat</td>\n    </tr>\n    <tr>\n      <th scope=\"row\">3</th>\n      <td>Larry</td>\n      <td>the Bird</td>\n      <td>@twitter</td>\n    </tr>\n  </tbody>\n</table>', 2),
(9, 'html', 'BS Responsive breakpoints', '// Extra small devices (portrait phones, less than 576px)\n// No media query since this is the default in Bootstrap\n\n// Small devices (landscape phones, 576px and up)\n@media (min-width: 576px) { ... }\n\n// Medium devices (tablets, 768px and up)\n@media (min-width: 768px) { ... }\n\n// Large devices (desktops, 992px and up)\n@media (min-width: 992px) { ... }\n\n// Extra large devices (large desktops, 1200px and up)\n@media (min-width: 1200px) { ... }', 5),
(10, 'html', 'BS Accordion', '<div id=\"accordion\">\n  <div class=\"card\">\n    <div class=\"card-header\" id=\"headingOne\">\n      <h5 class=\"mb-0\">\n        <button class=\"btn btn-link\" data-toggle=\"collapse\" data-target=\"#collapseOne\" aria-expanded=\"true\" aria-controls=\"collapseOne\">\n          Collapsible Group Item #1\n        </button>\n      </h5>\n    </div>\n\n    <div id=\"collapseOne\" class=\"collapse show\" aria-labelledby=\"headingOne\" data-parent=\"#accordion\">\n      <div class=\"card-body\">\n        Anim pariatur cliche reprehenderit.\n      </div>\n    </div>\n  </div>\n</div>', 4),
(12, 'html', 'BS Modal', '<!-- Button trigger modal -->\n<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#exampleModal\">\n  Launch demo modal\n</button>\n\n<!-- Modal -->\n<div class=\"modal fade\" id=\"exampleModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">\n  <div class=\"modal-dialog\" role=\"document\">\n    <div class=\"modal-content\">\n      <div class=\"modal-header\">\n        <h5 class=\"modal-title\" id=\"exampleModalLabel\">Modal title</h5>\n        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n          <span aria-hidden=\"true\">&times;</span>\n        </button>\n      </div>\n      <div class=\"modal-body\">\n        ...\n      </div>\n      <div class=\"modal-footer\">\n        <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n        <button type=\"button\" class=\"btn btn-primary\">Save changes</button>\n      </div>\n    </div>\n  </div>\n</div>', 3);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `boilerplates`
--
ALTER TABLE `boilerplates`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `boilerplates`
--
ALTER TABLE `boilerplates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
