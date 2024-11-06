CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(30) NOT NULL,
    role ENUM('visitor', 'admin') NOT NULL DEFAULT 'visitor',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (email, password, role) VALUES
('t@1.com', 't1', 'admin'),
('t@2.id', 't2', 'visitor'),
('t@3.com', 't3', 'visitor');

CREATE TABLE cards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    link VARCHAR(255) NOT NULL
);

INSERT INTO cards (title, description, image_path, link) VALUES
('Norway', 'Experience the majestic fjords and the vibrant Northern Lights in Norway, a land of stunning natural beauty.', 'assets/norway.jpg', 'pages/country.php?country=Norway'),
('Greece', 'Discover the rich culture and history of Greece, from ancient temples to modern cities.', 'assets/greece.jpg', 'pages/country.php?country=Greece'),
('Iceland', 'Discover the breathtaking natural wonders of Iceland.', 'assets/iceland.jpg', 'pages/country.php?country=Iceland'),
('Indonesia', 'Experience the rich tapestry of cultures and breathtaking landscapes in Indonesia, a stunning archipelago of over 17,000 islands.', 'assets/indonesia.jpg', 'pages/country.php?country=Indonesia'),
('Africa', 'Discover the diverse cultures, rich history, and stunning landscapes of Africa.', 'assets/africa.jpg', 'pages/country.php?country=Africa'),
('Antarctica', 'Venture to the last great wilderness on Earth, Antarctica, where pristine icebergs and vast glaciers create an otherworldly landscape.', 'assets/antarctica.jpg', 'pages/country.php?country=Antarctica');

CREATE TABLE cards_contents (
  id INT AUTO_INCREMENT PRIMARY KEY,
  card_id INT,
  section_title VARCHAR(255),
  section_content TEXT,
  image_path VARCHAR(255),
  FOREIGN KEY (card_id) REFERENCES cards(id)
);

INSERT INTO cards_contents (card_id, section_title, section_content, image_path) VALUES
('1', 'About Norway', "Norway offers some of the world's most breathtaking natural landscapes, from towering fjords to the northern lights. The country's famous fjords, like Geirangerfjord and Nærøyfjord, attract visitors year-round, with summer cruises and winter snow activities giving tourists a unique view of these glacially carved inlets. The midnight sun in the north provides an endless day, giving travelers time to hike, kayak, or just relax under the never-setting sun. Oslo, the capital, offers a vibrant cultural scene with museums, galleries, and historic sites such as the Viking Ship Museum, giving insight into the country's rich heritage.", "../assets/norway.jpg"),
('1', '', "In winter, Norway transforms into a snowy wonderland, ideal for skiing, snowboarding, and northern lights watching. Tromsø is one of the top destinations for aurora borealis sightings, where colorful lights dance across the night sky from September to April. For those interested in winter sports, the Lillehammer region boasts top-notch facilities, having hosted the Winter Olympics. The country's commitment to environmental sustainability ensures that natural treasures remain pristine, allowing travelers to enjoy unspoiled landscapes and ecosystems, making Norway a premier destination for eco-conscious adventurers.", "../assets/norway-alt.jpg"),
('2', 'About Greece', "Greece is a destination brimming with history, culture, and natural beauty, drawing millions of tourists annually. Its ancient ruins, like the Parthenon in Athens and the Temple of Apollo in Delphi, are must-sees for history enthusiasts looking to explore the origins of Western civilization. Beyond Athens, the islands of Santorini, Mykonos, and Crete offer a stunning blend of whitewashed architecture, turquoise waters, and picturesque sunsets. The country's rich mythology and historical landmarks make each city and island feel like a step back in time, with plenty of local stories, festivals, and traditions for travelers to explore.", "../assets/greece.jpg"),
('2', '', "Greek islands are famous for their hospitality and vibrant nightlife, and each has its unique charm. Santorini's volcanic landscapes and blue-domed churches provide a romantic backdrop, while Mykonos is known for its lively beach parties. Greece is also a paradise for food lovers, with Mediterranean flavors like olives, feta, seafood, and olive oil enhancing traditional dishes such as moussaka and souvlaki. Whether you're exploring the ancient ruins, soaking up the sun on pristine beaches, or enjoying the Greek hospitality, Greece offers a memorable and diverse travel experience.", "../assets/greece-alt.jpg"),
('3', 'About Iceland', "Iceland, often called the 'Land of Fire and Ice',is a spectacular destination for those seeking otherworldly landscapes and thrilling adventures. Its dramatic scenery includes volcanoes, glaciers, waterfalls, and geysers, offering a unique combination of geothermal wonders and Arctic beauty. The Golden Circle route is a popular way to explore some of Iceland's most famous attractions, including the Þingvellir National Park, Geysir geothermal area, and Gullfoss waterfall. The Blue Lagoon, a geothermal spa set in a lava field, is another must-visit attraction, providing a relaxing experience amid Iceland's rugged landscape.", "../assets/iceland.jpg"),
('3', '', "Wintertime in Iceland is perfect for viewing the northern lights, as the long nights and clear skies create an ideal setting to witness this natural spectacle. During the summer months, the midnight sun provides extra daylight, allowing travelers more time to explore the island's hiking trails, black sand beaches, and coastal cliffs populated by puffins. Reykjavik, the capital, is known for its colorful buildings, lively arts scene, and vibrant nightlife, providing a perfect blend of urban culture and nature-focused experiences. Iceland's commitment to sustainability is also notable, with eco-friendly practices and renewable energy being central to the country's infrastructure, making it an appealing destination for environmentally conscious tourists.", "../assets/iceland-alt.jpg"),
('4', 'About Indonesia', "Indonesia is a vibrant archipelago with over 17,000 islands, each offering a unique blend of natural beauty, cultural heritage, and modern attractions. Known for its pristine beaches, lush rainforests, and majestic volcanoes, Indonesia attracts travelers seeking diverse landscapes and adventure. The island of Bali, famous for its white sand beaches and spiritual ambiance, is a top destination, while Java boasts historic temples like Borobudur and Prambanan, showcasing Indonesia's rich Buddhist and Hindu heritage. For those drawn to unique wildlife, Sumatra and Borneo are home to endangered species like orangutans and Sumatran tigers, adding an eco-tourism appeal to the country's offerings.", "../assets/indonesia.jpg"),
('4', '', "Beyond nature, Indonesia's cultural richness shines through its traditional music, dance, and festivals, which vary significantly from one island to another. Visitors can experience the ancient customs of the Toraja people in Sulawesi, watch the dramatic Kecak dance in Bali, or witness the colorful batik-making traditions in Java. Indonesia also features lively cities like Jakarta, a bustling capital with a modern skyline, and Yogyakarta, known for its arts and vibrant history. With friendly locals, delicious cuisine, and a commitment to preserving its unique traditions, Indonesia provides an immersive experience that appeals to travelers from around the globe.", "../assets/indonesia-alt.jpg"),
('5', 'About Africa', "Africa is a continent of immense diversity, with landscapes that range from vast deserts and lush rainforests to rolling savannas and rugged coastlines. Many travelers visit Africa for safari experiences, particularly in countries like Kenya, Tanzania, and South Africa, where they can see the Big Five - lions, elephants, leopards, rhinoceroses, and buffalo - in their natural habitat. The Serengeti in Tanzania and the Maasai Mara in Kenya are famous for the Great Migration, where millions of wildebeest and zebras traverse the plains each year in search of greener pastures. These safaris not only allow tourists to experience Africa's wildlife up close but also support local conservation efforts and communities.", "../assets/africa.jpg"),
('5', '', "Apart from safaris, Africa boasts rich cultural diversity, with over 3,000 ethnic groups and languages, each offering a unique perspective on the continent's history and traditions. Egypt's ancient pyramids, Morocco's vibrant souks, and Ghana's historical slave castles give insight into Africa's complex past. Coastal destinations such as Zanzibar, Seychelles, and Cape Verde offer pristine beaches and crystal-clear waters, making them ideal for relaxing getaways. From historical sites and tribal villages to bustling cities and breathtaking natural wonders, Africa offers a wealth of experiences for every type of traveler.", "../assets/africa-alt.jpg"),
('6', 'About Antarctica', "Antarctica is a remote and pristine wilderness that offers an unforgettable adventure for intrepid travelers. Known for its surreal, icy landscapes and unique wildlife, the continent is a paradise for nature enthusiasts, scientists, and photographers. Icebergs, towering glaciers, and vast snow-covered plains create a scenery unlike any other, and the chance to see penguins, seals, and whales in their natural habitat makes the journey worthwhile. Many visitors to Antarctica travel via expedition cruises, which offer guided excursions and educational programs to help travelers understand the delicate ecosystem and the impact of climate change on the region.", "../assets/antarctica.jpg"),
('6', '', "Due to strict regulations designed to protect the environment, tourism in Antarctica is limited, which helps maintain its untouched beauty. While the continent lacks typical tourist infrastructure, visitors can still experience guided landings, ice trekking, and even overnight camping in certain areas. The long summer days between November and March provide more daylight hours for exploration and photography, while winter months are reserved for scientific research due to the extreme weather. For those who make the journey, Antarctica promises a once-in-a-lifetime experience, offering insight into one of Earth's last true wilderness areas.", "../assets/antarctica-alt.jpg");

ALTER TABLE cards_contents
DROP FOREIGN KEY cards_contents_ibfk_1;

ALTER TABLE cards_contents
ADD CONSTRAINT cards_contents_ibfk_1
FOREIGN KEY (card_id) REFERENCES cards(id) ON DELETE CASCADE;
