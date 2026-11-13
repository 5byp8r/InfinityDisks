-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11/12/2025 às 18:33
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_web_loja`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cds`
--

CREATE TABLE `cds` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `tipo` enum('vinil','cd') NOT NULL DEFAULT 'vinil',
  `musicas` varchar(2000) NOT NULL,
  `estoque` int(11) NOT NULL DEFAULT 0,
  `preco` decimal(10,2) NOT NULL DEFAULT 0.00,
  `data_cadastro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cds`
--

INSERT INTO `cds` (`id`, `descricao`, `categoria`, `tipo`, `musicas`, `estoque`, `preco`, `data_cadastro`) VALUES
(8, 'Álbum de MPB com arranjos acústicos.', 'MPB, Acústico', 'cd', 'Sertão, Vento Sul, Caminhos', 10, 29.99, '2025-12-11 07:53:44'),
(9, 'Coletânea de heavy metal com faixas lendárias.', 'Metal, Rock', 'vinil', 'Warriors, Steel Empire, Dark Throne', 12, 159.00, '2025-12-11 07:53:44'),
(10, 'Álbum indie alternativo com atmosfera melancólica.', 'Indie, Alternativo', 'vinil', 'Fading Lights, Ocean Calls, Moonrise', 9, 119.00, '2025-12-11 07:53:44'),
(11, 'Coletânea de samba raiz de grandes nomes.', 'Samba', 'cd', 'Partideiro, Raiz do Morro, Linha do Tempo', 25, 34.90, '2025-12-11 07:53:44'),
(12, 'Disco eletrônico com batidas experimentais.', 'Eletrônica, Experimental', 'vinil', 'Pulse, Mechanized, Echo Chamber', 5, 139.90, '2025-12-11 07:53:44'),
(13, 'Álbum country moderno com influências folk.', 'Country, Folk', 'cd', 'Road Home, Dust Trail, Wild Horse', 14, 32.00, '2025-12-11 07:53:44'),
(14, 'Coletânea de lo-fi hip hop para estudos.', 'Lo-Fi, Hip Hop', 'cd', 'Calm Breeze, Night Coding, Slow Steps', 100, 9.90, '2025-12-11 07:53:44'),
(15, 'Disco de música clássica orquestrada.', 'Clássica, Orquestral', 'cd', 'Sinfonia nº5, Abertura 1812, Noturno Op.9', 30, 49.99, '2025-12-11 07:53:44'),
(16, 'Álbum de reggae com vibrações tropicais.', 'Reggae', 'vinil', 'Island Love, Roots, Sunshine State', 12, 119.90, '2025-12-11 07:53:44'),
(17, 'Coletânea de trap nacional.', 'Trap, Hip-Hop', 'cd', 'Beat Frio, Autotune Life, 808 Dreams', 80, 14.90, '2025-12-11 07:53:44'),
(18, 'Álbum de ópera com grandes performances.', 'Ópera, Clássica', 'cd', 'Nessun Dorma, Habanera, La Donna è Mobile', 8, 59.99, '2025-12-11 07:53:44'),
(19, 'Disco punk com faixas rápidas e agressivas.', 'Punk, Rock', 'vinil', 'Street Fire, Crash Point, Red Alert', 7, 129.00, '2025-12-11 07:53:44'),
(20, 'Álbum R&B romântico e suave.', 'R&B', 'cd', 'Late Night, Velvet Skin, Touch Me', 20, 39.00, '2025-12-11 07:53:44'),
(21, 'Coletânea de músicas dos anos 80.', 'Retro, Pop', 'vinil', 'Flashback, Retro Wave, Digital Street', 16, 149.00, '2025-12-11 07:53:44'),
(22, 'Álbum acústico de folk europeu.', 'Folk', 'cd', 'Winter Song, Old Paths, River Flow', 11, 35.50, '2025-12-11 07:53:44'),
(23, 'Disco de funk brasileiro cheio de energia.', 'Funk', 'cd', 'Beat da Rua, Paredão, Movimento', 200, 7.90, '2025-12-11 07:53:44'),
(24, 'Coletânea de trilhas sonoras épicas.', 'Trilha Sonora, Orquestral', 'cd', 'Epic Rise, Fallen Kings, Glory Path', 10, 54.99, '2025-12-11 07:53:44'),
(25, 'Álbum soul vintage com groove marcante.', 'Soul', 'vinil', 'Golden Hour, Deep Blue, Midnight Groove', 9, 139.00, '2025-12-11 07:53:44'),
(26, 'Disco de música eletrônica dance.', 'EDM', 'cd', 'Sky High, Drop It, Vegas Night', 150, 12.90, '2025-12-11 07:53:44'),
(27, 'Álbum de pagode romântico.', 'Pagode', 'cd', 'Meu Lugar, Leve Vento, Sol e Mar', 26, 29.90, '2025-12-11 07:53:44'),
(28, 'Coletânea de música latina dançante.', 'Latina', 'vinil', 'Caliente, Fiesta, Movimiento', 8, 129.90, '2025-12-11 07:53:44'),
(29, 'Álbum gospel contemporâneo.', 'Gospel', 'cd', 'Luz do Amanhã, Fé Viva, Coração Aberto', 18, 34.00, '2025-12-11 07:53:44'),
(30, 'Disco de rock alternativo.', 'Rock, Alternativo', 'vinil', 'Skyfall, Break Me, Under Walls', 13, 139.00, '2025-12-11 07:53:44'),
(31, 'Álbum de piano solo relaxante.', 'Instrumental', 'cd', 'Soft Rain, Horizon Line, Early Morning', 22, 27.90, '2025-12-11 07:53:44'),
(32, 'Coletânea de hits do hip-hop.', 'Hip-Hop', 'cd', 'Block Party, Hustle Mode, East Side', 90, 15.00, '2025-12-11 07:53:44'),
(33, 'Álbum de bossa nova clássico.', 'Bossa Nova', 'cd', 'Mar Azul, Passos Leves, Noite Serena', 17, 31.00, '2025-12-11 07:53:44'),
(34, 'Disco de metal sinfônico.', 'Metal, Sinfônico', 'vinil', 'Fallen Angels, Dark Mist, Frozen Throne', 6, 159.90, '2025-12-11 07:53:44'),
(35, 'Álbum pop teen cheio de energia.', 'Pop', 'cd', 'Rainbow Lights, Kiss Kiss, On My Own', 120, 11.90, '2025-12-11 07:53:44'),
(36, 'Coletânea de rock nacional.', 'Rock Nacional', 'cd', 'Cidade Cinza, Estrada Livre, Horizonte', 19, 28.00, '2025-12-11 07:53:44'),
(37, 'Álbum instrumental épico.', 'Instrumental', 'vinil', 'Rise, Storm Ahead, Last Kingdom', 5, 149.00, '2025-12-11 07:53:44'),
(38, 'Disco de blues profundo.', 'Blues', 'vinil', 'Broken Strings, Whiskey Road, Old Train', 10, 129.00, '2025-12-11 07:53:44'),
(39, 'Álbum eletrônico minimalista.', 'Minimal, Eletrônica', 'cd', 'Echo, Pattern, Minimal Flow', 60, 9.99, '2025-12-11 07:53:44'),
(40, 'Coletânea de sertanejo universitário.', 'Sertanejo', 'cd', 'Festa Boa, Meu Interior, Aquele Beijo', 30, 24.90, '2025-12-11 07:53:44'),
(41, 'Álbum épico de trilha de filme.', 'Trilha Sonora', 'vinil', 'Hero Rising, Into The Battle, Aftermath', 7, 169.00, '2025-12-11 07:53:44'),
(42, 'Disco pop-rock moderno.', 'Pop-Rock', 'cd', 'Polar Lights, Falling Star, Drive', 21, 32.90, '2025-12-11 07:53:44'),
(43, 'Álbum de rap consciente.', 'Rap, Hip-Hop', 'cd', 'Real Talk, Justiça, Estrada', 100, 13.90, '2025-12-11 07:53:44'),
(44, 'Coletânea de dance dos anos 2000.', 'Dance, Eletrônica', 'cd', 'Beat Fever, Dancehall, Move On', 14, 27.90, '2025-12-11 07:53:44'),
(45, 'Álbum chillout atmosférico.', 'Chillout', 'cd', 'Deep Lagoon, Floating, Morning Drift', 120, 10.90, '2025-12-11 07:53:44'),
(46, 'Disco de samba enredo.', 'Samba', 'cd', 'Batuque Forte, Rua da Alegria, Carnaval Vivo', 23, 29.90, '2025-12-11 07:53:44'),
(47, 'Coletânea de rock progressivo.', 'Prog Rock', 'vinil', 'Time Spiral, Echoes of Mind, Nightfall', 5, 179.90, '2025-12-11 07:53:44'),
(48, 'Álbum romântico acústico.', 'Romântico, Acústico', 'cd', 'Meu Lugar, Nosso Segredo, Com Você', 27, 24.90, '2025-12-11 07:53:44'),
(49, 'Disco eletrônico futurista.', 'Eletrônica', 'cd', 'Orbit, Zero Gravity, Neon Nebula', 130, 11.90, '2025-12-11 07:53:44'),
(50, 'Coletânea de funk melody.', 'Funk Melody', 'cd', 'Coração Digital, Beijo Virtual, Meu Radar', 25, 21.00, '2025-12-11 07:53:44'),
(51, 'Álbum de metalcore pesado.', 'Metalcore', 'vinil', 'Break the Chains, Hollow, Fractured', 9, 179.00, '2025-12-11 07:53:44'),
(52, 'Disco alternativo introspectivo.', 'Indie', 'vinil', 'Shadows, Cold Morning, Lost Sign', 6, 149.00, '2025-12-11 07:53:44'),
(53, 'Coletânea de hits pop internacionais.', 'Pop', 'cd', 'Summer Dream, One More Time, Blue Sky', 200, 14.90, '2025-12-11 07:53:44'),
(54, 'Álbum clássico de violino solo.', 'Clássica', 'cd', 'Adagio, Lullaby, Elegy', 18, 39.90, '2025-12-11 07:53:44'),
(55, 'Disco de house music moderno.', 'House, Eletrônica', 'cd', 'Groove Line, Flash Night, Levels', 140, 12.90, '2025-12-11 07:53:44'),
(56, 'Álbum de forró tradicional.', 'Forró', 'cd', 'Xote do Sul, Arrasta Pé, Flor do Sertão', 29, 23.00, '2025-12-11 07:53:44'),
(57, 'Coletânea de indie pop suave.', 'Indie Pop', 'vinil', 'Peach Sky, Colorful Days, Soft Touch', 11, 139.50, '2025-12-11 07:53:44'),
(58, 'Álbum acústico folk americano.', 'Folk', 'cd', 'Morning Wood, Cedar Road, Snowflakes', 16, 32.90, '2025-12-11 07:53:44'),
(59, 'Disco de trap agressivo.', 'Trap', 'cd', 'Cold Streets, Flex Mode, Run It Up', 300, 9.90, '2025-12-11 07:53:44'),
(60, 'Coletânea de chorinho.', 'Choro', 'cd', 'Doce Melodia, Seresteiro, Valsa Rara', 14, 27.50, '2025-12-11 07:53:44'),
(61, 'Álbum synthwave neon.', 'Synthwave', 'vinil', 'Night Drive, Retro Dreams, Neon Fury', 7, 159.00, '2025-12-11 07:53:44'),
(62, 'Disco de ópera dramática.', 'Ópera', 'cd', 'Ave Maria, Libiamo, Vissi d’arte', 8, 59.00, '2025-12-11 07:53:44'),
(63, 'Álbum punk underground.', 'Punk', 'vinil', 'Street Fight, Riot Now, Dead Zone', 5, 139.00, '2025-12-11 07:53:44'),
(64, 'Coletânea de lounge music.', 'Lounge', 'cd', 'Soft Air, Cloud Nine, Green Tea', 110, 11.00, '2025-12-11 07:53:44'),
(65, 'Álbum R&B alternativo.', 'R&B', 'vinil', 'No Rules, Velvet, On My Skin', 9, 139.90, '2025-12-11 07:53:44'),
(66, 'Coletânea de hits EDM.', 'EDM', 'cd', 'Drop Again, Sky Limit, Energy', 500, 13.90, '2025-12-11 07:53:44'),
(67, 'Álbum de jazz clássico.', 'Jazz', 'vinil', 'Kind Love, Blue Velvet, Jazz Street', 11, 149.90, '2025-12-11 07:53:44'),
(68, 'Disco regional brasileiro.', 'Regional', 'cd', 'Caminho do Interior, Noite na Lapa, Viola Bruta', 20, 24.90, '2025-12-11 07:53:44'),
(69, 'Álbum de rock industrial.', 'Industrial, Rock', 'vinil', 'Metal Skin, Broken City, Red Pulses', 6, 159.90, '2025-12-11 07:53:44'),
(70, 'Coletânea de soul moderno.', 'Soul', 'cd', 'Deep Heart, Indigo, Feel the Warmth', 120, 10.90, '2025-12-11 07:53:44'),
(71, 'Álbum de música latina pop.', 'Latina, Pop', 'cd', 'La Vuelta, Amor Caliente, Fiesta Romana', 21, 29.90, '2025-12-11 07:53:44'),
(72, 'Disco de metal melódico.', 'Metal', 'vinil', 'Silver Blade, Lost Horizon, Frozen Hell', 8, 169.00, '2025-12-11 07:53:44'),
(73, 'Coletânea de música eletrônica chill.', 'Eletrônica, Chill', 'cd', 'Skylines, Clear Fog, Gentle Steps', 90, 10.50, '2025-12-11 07:53:44'),
(74, 'Álbum indie folk aconchegante.', 'Indie Folk', 'cd', 'Honey Wind, Soft Ground, Cabin Light', 18, 34.90, '2025-12-11 07:53:44'),
(75, 'Disco de samba moderno.', 'Samba', 'vinil', 'Rua Quente, Pé no Chão, Virou Festa', 13, 129.90, '2025-12-11 07:53:44'),
(76, 'Coletânea de músicas meditativas.', 'Meditativo', 'cd', 'Inner Peace, Deep Flow, Lotus Path', 150, 8.90, '2025-12-11 07:53:44'),
(77, 'Álbum de pop eletrônico.', 'Pop, Eletrônica', 'cd', 'Moon High, Digital Kiss, Red Neon', 20, 32.00, '2025-12-11 07:53:44'),
(78, 'Disco de bossa nova moderna.', 'Bossa Nova', 'vinil', 'Noite Clara, Sombra e Sal, Chuva Leve', 11, 139.00, '2025-12-11 07:53:44'),
(79, 'Álbum rock garage cru.', 'Rock', 'vinil', 'Dirty Hands, Alley Dogs, Broken Radio', 5, 149.00, '2025-12-11 07:53:44'),
(80, 'Coletânea gospel internacional.', 'Gospel', 'cd', 'Holy Fire, Ascend, Breath Again', 200, 12.00, '2025-12-11 07:53:44'),
(81, 'Álbum de música clássica barroca.', 'Clássica', 'cd', 'Canon em D, Primavera, Minueto', 19, 37.90, '2025-12-11 07:53:44'),
(82, 'Disco de trap melódico.', 'Trap', 'cd', 'Moonlight Drip, Soft 808, Sad Boy', 300, 9.50, '2025-12-11 07:53:44'),
(83, 'Álbum alternativo sonhador.', 'Indie', 'vinil', 'Cloud Walk, Pastel Sea, Glass Bird', 7, 149.90, '2025-12-11 07:53:44'),
(84, 'Coletânea de dance-pop.', 'Dance, Pop', 'cd', 'Move Me, Turn It Up, Paradise', 250, 11.90, '2025-12-11 07:53:44'),
(85, 'Álbum de rock clássico com remasterização moderna.', 'Rock, Clássicos', 'vinil', 'Highway Star, Smoke on the Water, Space Truckin', 15, 129.90, '2025-12-11 07:53:45'),
(86, 'Coletânea de jazz instrumental relaxante.', 'Jazz, Instrumental', 'cd', 'Blue Train, Moments Notice, Lazy Bird', 22, 39.90, '2025-12-11 07:53:45'),
(87, 'Disco pop contemporâneo cheio de hits dançantes.', 'Pop', 'vinil', 'Electric Heart, Summer Lights, Neon Dreams', 18, 149.50, '2025-12-11 07:53:45'),
(88, 'Álbum de MPB com arranjos acústicos.', 'MPB, Acústico', 'cd', 'Sertão, Vento Sul, Caminhos', 10, 29.99, '2025-12-11 07:53:45'),
(89, 'Coletânea de heavy metal com faixas lendárias.', 'Metal, Rock', 'vinil', 'Warriors, Steel Empire, Dark Throne', 12, 159.00, '2025-12-11 07:53:45'),
(90, 'Álbum indie alternativo com atmosfera melancólica.', 'Indie, Alternativo', 'vinil', 'Fading Lights, Ocean Calls, Moonrise', 9, 119.00, '2025-12-11 07:53:45'),
(91, 'Coletânea de samba raiz de grandes nomes.', 'Samba', 'cd', 'Partideiro, Raiz do Morro, Linha do Tempo', 25, 34.90, '2025-12-11 07:53:45'),
(92, 'Disco eletrônico com batidas experimentais.', 'Eletrônica, Experimental', 'vinil', 'Pulse, Mechanized, Echo Chamber', 5, 139.90, '2025-12-11 07:53:45'),
(93, 'Álbum country moderno com influências folk.', 'Country, Folk', 'cd', 'Road Home, Dust Trail, Wild Horse', 14, 32.00, '2025-12-11 07:53:45'),
(94, 'Coletânea de lo-fi hip hop para estudos.', 'Lo-Fi, Hip Hop', 'cd', 'Calm Breeze, Night Coding, Slow Steps', 100, 9.90, '2025-12-11 07:53:45'),
(95, 'Disco de música clássica orquestrada.', 'Clássica, Orquestral', 'cd', 'Sinfonia nº5, Abertura 1812, Noturno Op.9', 30, 49.99, '2025-12-11 07:53:45'),
(96, 'Álbum de reggae com vibrações tropicais.', 'Reggae', 'vinil', 'Island Love, Roots, Sunshine State', 12, 119.90, '2025-12-11 07:53:45'),
(97, 'Coletânea de trap nacional.', 'Trap, Hip-Hop', 'cd', 'Beat Frio, Autotune Life, 808 Dreams', 80, 14.90, '2025-12-11 07:53:45'),
(98, 'Álbum de ópera com grandes performances.', 'Ópera, Clássica', 'cd', 'Nessun Dorma, Habanera, La Donna è Mobile', 8, 59.99, '2025-12-11 07:53:45'),
(99, 'Disco punk com faixas rápidas e agressivas.', 'Punk, Rock', 'vinil', 'Street Fire, Crash Point, Red Alert', 7, 129.00, '2025-12-11 07:53:45'),
(100, 'Álbum R&B romântico e suave.', 'R&B', 'cd', 'Late Night, Velvet Skin, Touch Me', 20, 39.00, '2025-12-11 07:53:45'),
(101, 'Coletânea de músicas dos anos 80.', 'Retro, Pop', 'vinil', 'Flashback, Retro Wave, Digital Street', 16, 149.00, '2025-12-11 07:53:45'),
(102, 'Álbum acústico de folk europeu.', 'Folk', 'cd', 'Winter Song, Old Paths, River Flow', 11, 35.50, '2025-12-11 07:53:45'),
(103, 'Disco de funk brasileiro cheio de energia.', 'Funk', 'cd', 'Beat da Rua, Paredão, Movimento', 200, 7.90, '2025-12-11 07:53:45'),
(104, 'Coletânea de trilhas sonoras épicas.', 'Trilha Sonora, Orquestral', 'cd', 'Epic Rise, Fallen Kings, Glory Path', 10, 54.99, '2025-12-11 07:53:45'),
(105, 'Álbum soul vintage com groove marcante.', 'Soul', 'vinil', 'Golden Hour, Deep Blue, Midnight Groove', 9, 139.00, '2025-12-11 07:53:45'),
(106, 'Disco de música eletrônica dance.', 'EDM', 'cd', 'Sky High, Drop It, Vegas Night', 150, 12.90, '2025-12-11 07:53:45'),
(107, 'Álbum de pagode romântico.', 'Pagode', 'cd', 'Meu Lugar, Leve Vento, Sol e Mar', 26, 29.90, '2025-12-11 07:53:45'),
(108, 'Coletânea de música latina dançante.', 'Latina', 'vinil', 'Caliente, Fiesta, Movimiento', 8, 129.90, '2025-12-11 07:53:45'),
(109, 'Álbum gospel contemporâneo.', 'Gospel', 'cd', 'Luz do Amanhã, Fé Viva, Coração Aberto', 18, 34.00, '2025-12-11 07:53:45'),
(110, 'Disco de rock alternativo.', 'Rock, Alternativo', 'vinil', 'Skyfall, Break Me, Under Walls', 13, 139.00, '2025-12-11 07:53:45'),
(111, 'Álbum de piano solo relaxante.', 'Instrumental', 'cd', 'Soft Rain, Horizon Line, Early Morning', 22, 27.90, '2025-12-11 07:53:45'),
(112, 'Coletânea de hits do hip-hop.', 'Hip-Hop', 'cd', 'Block Party, Hustle Mode, East Side', 90, 15.00, '2025-12-11 07:53:45'),
(113, 'Álbum de bossa nova clássico.', 'Bossa Nova', 'cd', 'Mar Azul, Passos Leves, Noite Serena', 17, 31.00, '2025-12-11 07:53:45'),
(114, 'Disco de metal sinfônico.', 'Metal, Sinfônico', 'vinil', 'Fallen Angels, Dark Mist, Frozen Throne', 6, 159.90, '2025-12-11 07:53:45'),
(115, 'Álbum pop teen cheio de energia.', 'Pop', 'cd', 'Rainbow Lights, Kiss Kiss, On My Own', 120, 11.90, '2025-12-11 07:53:45'),
(116, 'Coletânea de rock nacional.', 'Rock Nacional', 'cd', 'Cidade Cinza, Estrada Livre, Horizonte', 19, 28.00, '2025-12-11 07:53:45'),
(117, 'Álbum instrumental épico.', 'Instrumental', 'vinil', 'Rise, Storm Ahead, Last Kingdom', 5, 149.00, '2025-12-11 07:53:45'),
(118, 'Disco de blues profundo.', 'Blues', 'vinil', 'Broken Strings, Whiskey Road, Old Train', 10, 129.00, '2025-12-11 07:53:45'),
(119, 'Álbum eletrônico minimalista.', 'Minimal, Eletrônica', 'cd', 'Echo, Pattern, Minimal Flow', 60, 9.99, '2025-12-11 07:53:45'),
(120, 'Coletânea de sertanejo universitário.', 'Sertanejo', 'cd', 'Festa Boa, Meu Interior, Aquele Beijo', 30, 24.90, '2025-12-11 07:53:45'),
(121, 'Álbum épico de trilha de filme.', 'Trilha Sonora', 'vinil', 'Hero Rising, Into The Battle, Aftermath', 7, 169.00, '2025-12-11 07:53:45'),
(122, 'Disco pop-rock moderno.', 'Pop-Rock', 'cd', 'Polar Lights, Falling Star, Drive', 21, 32.90, '2025-12-11 07:53:45'),
(123, 'Álbum de rap consciente.', 'Rap, Hip-Hop', 'cd', 'Real Talk, Justiça, Estrada', 100, 13.90, '2025-12-11 07:53:45'),
(124, 'Coletânea de dance dos anos 2000.', 'Dance, Eletrônica', 'cd', 'Beat Fever, Dancehall, Move On', 14, 27.90, '2025-12-11 07:53:45'),
(125, 'Álbum chillout atmosférico.', 'Chillout', 'cd', 'Deep Lagoon, Floating, Morning Drift', 120, 10.90, '2025-12-11 07:53:45'),
(126, 'Disco de samba enredo.', 'Samba', 'cd', 'Batuque Forte, Rua da Alegria, Carnaval Vivo', 23, 29.90, '2025-12-11 07:53:45'),
(127, 'Coletânea de rock progressivo.', 'Prog Rock', 'vinil', 'Time Spiral, Echoes of Mind, Nightfall', 5, 179.90, '2025-12-11 07:53:45'),
(128, 'Álbum romântico acústico.', 'Romântico, Acústico', 'cd', 'Meu Lugar, Nosso Segredo, Com Você', 27, 24.90, '2025-12-11 07:53:45'),
(129, 'Disco eletrônico futurista.', 'Eletrônica', 'cd', 'Orbit, Zero Gravity, Neon Nebula', 130, 11.90, '2025-12-11 07:53:45'),
(130, 'Coletânea de funk melody.', 'Funk Melody', 'cd', 'Coração Digital, Beijo Virtual, Meu Radar', 25, 21.00, '2025-12-11 07:53:45'),
(131, 'Álbum de metalcore pesado.', 'Metalcore', 'vinil', 'Break the Chains, Hollow, Fractured', 9, 179.00, '2025-12-11 07:53:45'),
(132, 'Disco alternativo introspectivo.', 'Indie', 'vinil', 'Shadows, Cold Morning, Lost Sign', 6, 149.00, '2025-12-11 07:53:45'),
(133, 'Coletânea de hits pop internacionais.', 'Pop', 'cd', 'Summer Dream, One More Time, Blue Sky', 200, 14.90, '2025-12-11 07:53:45'),
(134, 'Álbum clássico de violino solo.', 'Clássica', 'cd', 'Adagio, Lullaby, Elegy', 18, 39.90, '2025-12-11 07:53:45'),
(135, 'Disco de house music moderno.', 'House, Eletrônica', 'cd', 'Groove Line, Flash Night, Levels', 140, 12.90, '2025-12-11 07:53:45'),
(136, 'Álbum de forró tradicional.', 'Forró', 'cd', 'Xote do Sul, Arrasta Pé, Flor do Sertão', 29, 23.00, '2025-12-11 07:53:45'),
(137, 'Coletânea de indie pop suave.', 'Indie Pop', 'vinil', 'Peach Sky, Colorful Days, Soft Touch', 11, 139.50, '2025-12-11 07:53:45'),
(138, 'Álbum acústico folk americano.', 'Folk', 'cd', 'Morning Wood, Cedar Road, Snowflakes', 16, 32.90, '2025-12-11 07:53:45'),
(139, 'Disco de trap agressivo.', 'Trap', 'cd', 'Cold Streets, Flex Mode, Run It Up', 300, 9.90, '2025-12-11 07:53:45'),
(140, 'Coletânea de chorinho.', 'Choro', 'cd', 'Doce Melodia, Seresteiro, Valsa Rara', 14, 27.50, '2025-12-11 07:53:45'),
(141, 'Álbum synthwave neon.', 'Synthwave', 'vinil', 'Night Drive, Retro Dreams, Neon Fury', 7, 159.00, '2025-12-11 07:53:45'),
(142, 'Disco de ópera dramática.', 'Ópera', 'cd', 'Ave Maria, Libiamo, Vissi d’arte', 8, 59.00, '2025-12-11 07:53:45'),
(143, 'Álbum punk underground.', 'Punk', 'vinil', 'Street Fight, Riot Now, Dead Zone', 5, 139.00, '2025-12-11 07:53:45'),
(144, 'Coletânea de lounge music.', 'Lounge', 'cd', 'Soft Air, Cloud Nine, Green Tea', 110, 11.00, '2025-12-11 07:53:45'),
(145, 'Álbum R&B alternativo.', 'R&B', 'vinil', 'No Rules, Velvet, On My Skin', 9, 139.90, '2025-12-11 07:53:45'),
(146, 'Coletânea de hits EDM.', 'EDM', 'cd', 'Drop Again, Sky Limit, Energy', 500, 13.90, '2025-12-11 07:53:45'),
(147, 'Álbum de jazz clássico.', 'Jazz', 'vinil', 'Kind Love, Blue Velvet, Jazz Street', 11, 149.90, '2025-12-11 07:53:45'),
(148, 'Disco regional brasileiro.', 'Regional', 'cd', 'Caminho do Interior, Noite na Lapa, Viola Bruta', 20, 24.90, '2025-12-11 07:53:45'),
(149, 'Álbum de rock industrial.', 'Industrial, Rock', 'vinil', 'Metal Skin, Broken City, Red Pulses', 6, 159.90, '2025-12-11 07:53:45'),
(150, 'Coletânea de soul moderno.', 'Soul', 'cd', 'Deep Heart, Indigo, Feel the Warmth', 120, 10.90, '2025-12-11 07:53:45'),
(151, 'Álbum de música latina pop.', 'Latina, Pop', 'cd', 'La Vuelta, Amor Caliente, Fiesta Romana', 21, 29.90, '2025-12-11 07:53:45'),
(152, 'Disco de metal melódico.', 'Metal', 'vinil', 'Silver Blade, Lost Horizon, Frozen Hell', 8, 169.00, '2025-12-11 07:53:45'),
(153, 'Coletânea de música eletrônica chill.', 'Eletrônica, Chill', 'cd', 'Skylines, Clear Fog, Gentle Steps', 90, 10.50, '2025-12-11 07:53:45'),
(154, 'Álbum indie folk aconchegante.', 'Indie Folk', 'cd', 'Honey Wind, Soft Ground, Cabin Light', 18, 34.90, '2025-12-11 07:53:45'),
(155, 'Disco de samba moderno.', 'Samba', 'vinil', 'Rua Quente, Pé no Chão, Virou Festa', 13, 129.90, '2025-12-11 07:53:45'),
(156, 'Coletânea de músicas meditativas.', 'Meditativo', 'cd', 'Inner Peace, Deep Flow, Lotus Path', 150, 8.90, '2025-12-11 07:53:45'),
(157, 'Álbum de pop eletrônico.', 'Pop, Eletrônica', 'cd', 'Moon High, Digital Kiss, Red Neon', 20, 32.00, '2025-12-11 07:53:45'),
(158, 'Disco de bossa nova moderna.', 'Bossa Nova', 'vinil', 'Noite Clara, Sombra e Sal, Chuva Leve', 11, 139.00, '2025-12-11 07:53:45'),
(159, 'Álbum rock garage cru.', 'Rock', 'vinil', 'Dirty Hands, Alley Dogs, Broken Radio', 5, 149.00, '2025-12-11 07:53:45'),
(160, 'Coletânea gospel internacional.', 'Gospel', 'cd', 'Holy Fire, Ascend, Breath Again', 200, 12.00, '2025-12-11 07:53:45'),
(161, 'Álbum de música clássica barroca.', 'Clássica', 'cd', 'Canon em D, Primavera, Minueto', 19, 37.90, '2025-12-11 07:53:45'),
(162, 'Disco de trap melódico.', 'Trap', 'cd', 'Moonlight Drip, Soft 808, Sad Boy', 300, 9.50, '2025-12-11 07:53:45'),
(163, 'Álbum alternativo sonhador.', 'Indie', 'vinil', 'Cloud Walk, Pastel Sea, Glass Bird', 7, 149.90, '2025-12-11 07:53:45'),
(164, 'Coletânea de dance-pop.', 'Dance, Pop', 'cd', 'Move Me, Turn It Up, Paradise', 250, 11.90, '2025-12-11 07:53:45');

-- --------------------------------------------------------

--
-- Estrutura para tabela `itensvenda`
--

CREATE TABLE `itensvenda` (
  `id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 0,
  `id_cd` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `itensvenda`
--

INSERT INTO `itensvenda` (`id`, `quantidade`, `id_cd`, `id_venda`) VALUES
(2, 2, 8, 2),
(3, 7, 8, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `tipo` enum('user','admin') NOT NULL DEFAULT 'user',
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_criacao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `tipo`, `nome`, `email`, `senha`, `data_criacao`) VALUES
(1, 'admin', 'p', 'p@p', '1', '2025-12-11 07:09:40'),
(3, 'user', 'a', 'a@q', '1', '2025-12-11 08:39:37'),
(5, 'user', 'g', 'G@g', '1', '2025-12-11 08:41:24'),
(6, 'user', 'ab', 'ab@a', '1', '2025-12-11 08:42:10'),
(7, 'user', 'af', 'af@a', '1', '2025-12-11 08:44:13'),
(8, 'user', 'g', 'g@gggg', '1', '2025-12-11 08:44:46'),
(9, 'user', 'gg', 'gf@gf', '1', '2025-12-11 08:45:11');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `data_venda` datetime NOT NULL DEFAULT current_timestamp(),
  `valor_venda` decimal(10,2) NOT NULL DEFAULT 0.00,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `vendas`
--

INSERT INTO `vendas` (`id`, `data_venda`, `valor_venda`, `id_user`) VALUES
(1, '2025-12-11 07:13:05', 539.40, 1),
(2, '2025-12-11 09:12:00', 59.98, 1),
(3, '2025-12-11 10:54:16', 209.93, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cds`
--
ALTER TABLE `cds`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `itensvenda`
--
ALTER TABLE `itensvenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_venda` (`id_venda`),
  ADD KEY `id_cd` (`id_cd`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cds`
--
ALTER TABLE `cds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT de tabela `itensvenda`
--
ALTER TABLE `itensvenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `itensvenda`
--
ALTER TABLE `itensvenda`
  ADD CONSTRAINT `itensvenda_ibfk_1` FOREIGN KEY (`id_venda`) REFERENCES `vendas` (`id`),
  ADD CONSTRAINT `itensvenda_ibfk_2` FOREIGN KEY (`id_cd`) REFERENCES `cds` (`id`);

--
-- Restrições para tabelas `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `vendas_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
