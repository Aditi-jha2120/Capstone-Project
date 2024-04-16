
CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  img_url VARCHAR(255) NOT NULL,
  description text NOT NULL,
  category VARCHAR(50) NOT NULL,
  price VARCHAR(10) NOT NULL,
  on_sale TINYINT(1) NOT NULL
);

--
-- Dumping data for table products
--

INSERT INTO products (id, title, img_url, description, category, price, on_sale) VALUES
(1, 'Handcrafted Mug', 'Handcrafted-Mug.jpg', 'This beautiful mug is handcrafted by skilled artisans. It features a unique design and is perfect for your morning coffee or tea.', 'Mugs', '19.99', 0),
(2, 'Artisanal Bowl', 'Artisanal-Bowl.jpg', 'This artisanal bowl is perfect for serving soups, salads, or pasta. Its unique design and high-quality craftsmanship make it a standout piece.', 'Bowls', '29.99', 1),
(3, 'Elegant Plate', 'Elegant-Plate.jpg', 'This elegant plate is perfect for serving appetizers, desserts, or main courses. Its classic design and durable construction make it a versatile addition to your tableware collection.', 'Plates', '24.99', 0),
(4, 'Candle Holder Set', 'Candle-Holder-Set.jpg', 'This set of candle holders is perfect for adding a warm, inviting glow to your home. The set includes three different sizes, each with a unique design.', 'Candle Holders', '39.99', 1),
(5, 'Classic Mug', 'Classic-Mug.jpg', 'This classic mug is perfect for your morning coffee or tea. Its simple, timeless design makes it a versatile addition to your kitchen.', 'Mugs', '14.99', 0),
(6, 'Rustic Bowl', 'Rustic-Bowl.jpg', 'This rustic bowl is perfect for serving soups, salads, or pasta. Its earthy tones and textured finish make it a unique addition to your tableware collection.', 'Bowls', '19.99', 0),
(7, 'Modern Plate', 'Modern-Plate.jpg', 'This modern plate is perfect for serving appetizers, desserts, or main courses. Its sleek design and durable construction make it a stylish addition to your tableware collection.', 'Plates', '29.99', 1),
(8, 'Tea Light Holder', 'Tea-Light-Holder.jpg', 'This tea light holder is perfect for adding a warm, inviting glow to your home. Its simple, elegant design makes it a versatile addition to any room.', 'Candle Holders', '9.99', 0),
(9, 'Colorful Mug', 'Colorful-Mug.jpg', 'This colorful mug is perfect for your morning coffee or tea. Its vibrant colors and unique design make it a fun addition to your kitchen.', 'Mugs', '17.99', 1),
(10, 'Patterned Bowl', 'Patterned-Bowl.jpg', 'This patterned bowl is perfect for serving soups, salads, or pasta. Its bold pattern and durable construction make it a standout piece.', 'Bowls', '24.99', 0),
(11, 'Charger Plate', 'Charger-Plate.jpg', 'This charger plate is perfect for adding a touch of elegance to your table setting. Its classic design and durable construction make it a versatile addition to your tableware collection.', 'Plates', '34.99', 1),
(12, 'Metallic Candle Holder', 'Metallic-Candle-Holder.jpg', 'This metallic candle holder is perfect for adding a touch of glamour to your home. Its metallic finish and unique design make it a standout piece.', 'Candle Holders', '19.99', 1);

-- --------------------------------------------------------

--
-- Table structure for table users
--

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL,
  password VARCHAR(100) NOT NULL
);

--
-- Dumping data for table users
--

INSERT INTO users (id, first_name, last_name, email, password) VALUES
(1, 'Meredith', 'Woodard', 'cupoge@gmail.com', '$2y$10$6uFrqigFFS4lpsYNdDc.W.saUWMchVwlwiPPV.Azpv7kbln8uX0je'),
(2, 'Jakeem', 'Bauer', 'lyzididij@gmail.com', '$2y$10$SFkHXKpB.AaKJZ3F/S8wBOvYsnppBY4TwMRrA8zLPVnnnro5aQgLu'),
(3, 'Kelsie', 'Newton', 'fejonoti@gmail.com', '$2y$10$DFpcp7QQTS9DS7SqpQeRHe6H1KbPv7yFb64ku83UZZSjZppFX35P.'),
(4, 'Lars', 'Gaines', 'hihuvomur@gmail.com', '$2y$10$EA4/0cxiVTJLk5vpuim2L.sN0/R9F/nY.pw3b0LGXaLZujfLsBkd.');


-- orders

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_num VARCHAR(50) NOT NULL,
    order_date DATE NOT NULL,
    user_id INT NOT NULL,
    tax DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- orders items

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE videos (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    video_link VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL
);

INSERT INTO videos (id, video_link, title, description) VALUES
(1, 'https://www.youtube.com/embed/OVtjG6DawxE', 'HOW I MAKE CERAMICS AT HOME (the entire pottery process) | lolita olympia | Moderate\n', 'Follow along as Lolita Olympia shares her home ceramics process. Beginning with wedging clay, she molds and shapes it on her pottery wheel, creating unique forms. After drying, pieces are trimmed, bisque-fired, glazed, and fired again. Finally, each piece is lovingly finished, resulting in handmade ceramics imbued with personal touch and creativity.'),
(2, 'https://www.youtube.com/embed/6bZTr9kAxgo', 'Intermediate lesson on bowls (making a better functional bowl)\n', 'In this intermediate lesson on bowl-making, focus on refining form and function. Start by centering clay on the wheel, pulling walls evenly to desired thickness. Pay attention to shaping for optimal functionality, ensuring even thickness and smooth rims. Experiment with decorative elements and glazes for personalized touches. Bisque and glaze-fire for durability.'),
(3, 'https://www.youtube.com/embed/PSHQxlbMNpE', 'Basics of Ceramics Clay Stages, Storage, Handbuilding Tools and Clean Up | Intermediate', 'Learn intermediate ceramic basics with a focus on clay stages, storage, handbuilding tools, and cleanup. Explore clay preparation from raw to workable stages, with tips on storage to maintain moisture. Master essential handbuilding tools for shaping and texturing. Discover efficient cleanup techniques for a tidy and organized studio space.');


