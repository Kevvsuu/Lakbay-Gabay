const regions = {
    "NCR": ["Manila", "Quezon City", "Caloocan", "Las Piñas", "Makati", "Malabon", "Mandaluyong", "Marikina", "Muntinlupa", "Navotas", "Parañaque", "Pasay", "Pasig", "San Juan", "Taguig", "Valenzuela"],
    "CAR": ["Abra", "Apayao", "Benguet", "Ifugao", "Kalinga", "Mountain Province"],
    "BARMM": ["Basilan", "Lanao del Sur", "Maguindanao", "Sulu", "Tawi-Tawi"],
    "NIR": ["Negros Occidental", "Negros Oriental"],
    "Region-1": ["Ilocos Norte", "Ilocos Sur", "La Union", "Pangasinan"],
    "Region-2": ["Batanes", "Cagayan", "Isabela", "Nueva Vizcaya", "Quirino"],
    "Region-3": ["Aurora", "Bataan", "Bulacan", "Nueva Ecija", "Pampanga", "Tarlac", "Zambales"],
    "Region-4A": ["Batangas", "Cavite", "Laguna", "Quezon", "Rizal"],
    "Region-4B": ["Marinduque", "Occidental Mindoro", "Oriental Mindoro", "Palawan", "Romblon"],
    "Region-5": ["Albay", "Camarines Norte", "Camarines Sur", "Catanduanes", "Masbate", "Sorsogon"],
    "Region-6": ["Aklan", "Antique", "Capiz", "Guimaras", "Iloilo", "Negros Occidental"],
    "Region-7": ["Bohol", "Cebu", "Negros Oriental", "Siquijor"],
    "Region-8": ["Biliran", "Eastern Samar", "Leyte", "Northern Samar", "Samar", "Southern Leyte"],
    "Region-9": ["Zamboanga del Norte", "Zamboanga del Sur", "Zamboanga Sibugay"],
    "Region-10": ["Bukidnon", "Camiguin", "Lanao del Norte", "Misamis Occidental", "Misamis Oriental"],
    "Region-11": ["Davao de Oro", "Davao del Norte", "Davao del Sur", "Davao Occidental", "Davao Oriental"],
    "Region-12": ["Cotabato", "Sarangani", "South Cotabato", "Sultan Kudarat"],
    "Region-13": ["Agusan del Norte", "Agusan del Sur", "Dinagat Islands", "Surigao del Norte", "Surigao del Sur"],
};

const provinces = {
    // NCR
    "Manila": ["Manila"],
    "Quezon City": ["Quezon City"],
    "Caloocan": ["Caloocan"],
    "Las Piñas": ["Las Piñas"],
    "Makati": ["Makati"],
    "Malabon": ["Malabon"],
    "Mandaluyong": ["Mandaluyong"],
    "Marikina": ["Marikina"],
    "Muntinlupa": ["Muntinlupa"],
    "Navotas": ["Navotas"],
    "Parañaque": ["Parañaque"],
    "Pasay": ["Pasay"],
    "Pasig": ["Pasig"],
    "San Juan": ["San Juan"],
    "Taguig": ["Taguig"],
    "Valenzuela": ["Valenzuela"],

    // CAR
    "Abra": ["Bangued", "Boliney", "Bucay", "Bucloc", "Daguioman", "Danglas", "Dolores", "La Paz", "Lacub", "Lagangilang", "Lagayan", "Langiden", "Licuan-Baay", "Luba", "Malibcong", "Manabo", "Peñarrubia", "Pidigan", "Pilar", "Sallapadan", "San Isidro", "San Juan", "San Quintin", "Tayum", "Tineg", "Tubo", "Villaviciosa"],
    "Apayao": ["Calanasan", "Conner", "Flora", "Kabugao", "Luna", "Pudtol", "Santa Marcela"],
    "Benguet": ["Atok", "Baguio City", "Bakun", "Bokod", "Buguias", "Itogon", "Kabayan", "Kapangan", "Kibungan", "La Trinidad", "Mankayan", "Sablan", "Tuba", "Tublay"],
    "Ifugao": ["Aguinaldo", "Alfonso Lista", "Asipulo", "Banaue", "Hingyon", "Hungduan", "Kiangan", "Lagawe", "Lamut", "Mayoyao", "Tinoc"],
    "Kalinga": ["Balbalan", "Lubuagan", "Pasil", "Pinukpuk", "Rizal", "Tabuk City", "Tanudan", "Tinglayan"],
    "Mountain Province": ["Barlig", "Bauko", "Besao", "Bontoc", "Natonin", "Paracelis", "Sabangan", "Sadanga", "Sagada", "Tadian"],

    // BARMM
    "Basilan": ["Isabela City", "Lamitan City", "Akbar", "Al-Barka", "Hadji Mohammad Ajul", "Hadji Muhtamad", "Lantawan", "Maluso", "Sumisip", "Tabuan-Lasa", "Tipo-Tipo", "Tuburan", "Ungkaya Pukan"],
    "Lanao del Sur": ["Marawi City", "Bacolod-Kalawi", "Balabagan", "Balindong", "Bayang", "Binidayan", "Buadiposo-Buntong", "Bubong", "Butig", "Calanogas", "Ditsaan-Ramain", "Ganassi", "Kapai", "Kapatagan", "Lumba-Bayabao", "Lumbaca-Unayan", "Lumbatan", "Lumbayanague", "Madalum", "Madamba", "Maguing", "Malabang", "Marantao", "Marogong", "Masiu", "Mulondo", "Pagayawan", "Piagapo", "Poona Bayabao", "Pualas", "Saguiaran", "Sultan Dumalondong", "Picong", "Tagoloan II", "Tamparan", "Taraka", "Tubaran", "Tugaya", "Wao"],
    "Maguindanao": ["Ampatuan", "Barira", "Buldon", "Buluan", "Datu Abdullah Sangki", "Datu Anggal Midtimbang", "Datu Blah T. Sinsuat", "Datu Hoffer Ampatuan", "Datu Odin Sinsuat", "Datu Paglas", "Datu Piang", "Datu Salibo", "Datu Saudi-Ampatuan", "Datu Unsay", "Gen. S.K. Pendatun", "Guindulungan", "Kabuntalan", "Mamasapano", "Mangudadatu", "Matanog", "Northern Kabuntalan", "Pagalungan", "Paglat", "Pandag", "Parang", "Rajah Buayan", "Shariff Aguak", "Shariff Saydona Mustapha", "South Upi", "Sultan Kudarat", "Sultan Mastura", "Sultan sa Barongis", "Talayan", "Talitay", "Upi"],
    "Sulu": ["Jolo", "Indanan", "Kalingalan Caluang", "Lugus", "Luuk", "Maimbung", "Old Panamao", "Omar", "Pandami", "Panglima Estino", "Pangutaran", "Parang", "Pata", "Patikul", "Siasi", "Talipao", "Tapul", "Tongkil"],
    "Tawi-Tawi": ["Bongao", "Languyan", "Mapun", "Panglima Sugala", "Sapa-Sapa", "Sibutu", "Simunul", "Sitangkai", "South Ubian", "Tandubas", "Turtle Islands"],

    // NIR
    "Negros Occidental": ["Bacolod City", "Bago City", "Binalbagan", "Cadiz City", "Calatrava", "Candoni", "Cauayan", "Enrique B. Magalona", "Escalante City", "Himamaylan City", "Hinigaran", "Hinoba-an", "Ilog", "Isabela", "Kabankalan City", "La Carlota City", "La Castellana", "Manapla", "Moises Padilla", "Murcia", "Pontevedra", "Pulupandan", "Sagay City", "Salvador Benedicto", "San Carlos City", "San Enrique", "Silay City", "Sipalay City", "Talisay City", "Toboso", "Valladolid", "Victorias City"],
    "Negros Oriental": ["Bais City", "Bayawan City", "Bindoy", "Canlaon City", "Dauin", "Dumaguete City", "Guihulngan City", "Jimalalud", "La Libertad", "Mabinay", "Manjuyod", "Pamplona", "San Jose", "Santa Catalina", "Siaton", "Sibulan", "Tanjay City", "Tayasan", "Valencia", "Vallehermoso", "Zamboanguita"],

    // Region-1
    "Ilocos Norte": ["Adams", "Bacarra", "Badoc", "Bangui", "Banna", "Batac City", "Burgos", "Carasi", "Currimao", "Dingras", "Dumalneg", "Laoag City", "Marcos", "Nueva Era", "Pagudpud", "Paoay", "Pasuquin", "Piddig", "Pinili", "San Nicolas", "Sarrat", "Solsona", "Vintar"],
    "Ilocos Sur": ["Alilem", "Banayoyo", "Bantay", "Burgos", "Cabugao", "Candon City", "Caoayan", "Cervantes", "Galimuyod", "Gregorio del Pilar", "Lidlidda", "Magsingal", "Nagbukel", "Narvacan", "Quirino", "Salcedo", "San Emilio", "San Esteban", "San Ildefonso", "San Juan", "San Vicente", "Santa", "Santa Catalina", "Santa Cruz", "Santa Lucia", "Santa Maria", "Santiago", "Santo Domingo", "Sigay", "Sinait", "Sugpon", "Suyo", "Tagudin", "Vigan City"],
    "La Union": ["Agoo", "Aringay", "Bacnotan", "Bagulin", "Balaoan", "Bangar", "Bauang", "Burgos", "Caba", "Luna", "Naguilian", "Pugo", "Rosario", "San Fernando City", "San Gabriel", "San Juan", "Santo Tomas", "Santol", "Sudipen", "Tubao"],
    "Pangasinan": ["Agno", "Aguilar", "Alaminos City", "Alcala", "Anda", "Asingan", "Balungao", "Bani", "Basista", "Bautista", "Bayambang", "Binalonan", "Binmaley", "Bolinao", "Bugallon", "Burgos", "Calasiao", "Dagupan City", "Dasol", "Infanta", "Labrador", "Laoac", "Lingayen", "Mabini", "Malasiqui", "Manaoag", "Mangaldan", "Mangatarem", "Mapandan", "Natividad", "Pozorrubio", "Rosales", "San Carlos City", "San Fabian", "San Jacinto", "San Manuel", "San Nicolas", "San Quintin", "Santa Barbara", "Santa Maria", "Santo Tomas", "Sison", "Sual", "Tayug", "Umingan", "Urbiztondo", "Urdaneta City", "Villasis"],

    // Region-2
    "Batanes": ["Basco", "Itbayat", "Ivana", "Mahatao", "Sabtang", "Uyugan"],
    "Cagayan": ["Abulug", "Alcala", "Allacapan", "Amulung", "Aparri", "Baggao", "Ballesteros", "Buguey", "Calayan", "Camalaniugan", "Claveria", "Enrile", "Gattaran", "Gonzaga", "Iguig", "Lal-lo", "Lasam", "Pamplona", "Peñablanca", "Piat", "Rizal", "Sanchez-Mira", "Santa Ana", "Santa Praxedes", "Santa Teresita", "Santo Niño", "Solana", "Tuao", "Tuguegarao City"],
    "Isabela": ["Alicia", "Angadanan", "Aurora", "Benito Soliven", "Burgos", "Cabagan", "Cabatuan", "Cauayan City", "Cordon", "Delfin Albano", "Dinapigue", "Divilacan", "Echague", "Gamu", "Ilagan City", "Jones", "Luna", "Maconacon", "Mallig", "Naguilian", "Palanan", "Quezon", "Quirino", "Ramon", "Reina Mercedes", "Roxas", "San Agustin", "San Guillermo", "San Isidro", "San Manuel", "San Mariano", "San Mateo", "San Pablo", "Santa Maria", "Santiago City", "Santo Tomas", "Tumauini"],
    "Nueva Vizcaya": ["Alfonso Castaneda", "Ambaguio", "Aritao", "Bagabag", "Bambang", "Bayombong", "Diadi", "Dupax del Norte", "Dupax del Sur", "Kasibu", "Kayapa", "Quezon", "Santa Fe", "Solano", "Villaverde"],
    "Quirino": ["Aglipay", "Cabarroguis", "Diffun", "Maddela", "Nagtipunan", "Saguday"],

    // Region-3 (already provided in your example)
    "Aurora": ["Baler", "Casiguran", "Dilasag", "Dinalungan", "Dingalan", "Dipaculao", "Maria Aurora", "San Luis"],
    "Bataan": ["Abucay", "Bagac", "Balanga City", "Dinalupihan", "Hermosa", "Limay", "Mariveles", "Morong", "Orani", "Orion", "Pilar", "Samal"],
    "Bulacan": ["Angat", "Balagtas", "Baliuag", "Bocaue", "Bulacan", "Bustos", "Calumpit", "Doña Remedios Trinidad", "Guiguinto", "Hagonoy", "Malolos City", "Marilao", "Meycauayan City", "Norzagaray", "Obando", "Pandi", "Paombong", "Plaridel", "Pulilan", "San Ildefonso", "San Jose del Monte City", "San Miguel", "San Rafael", "Santa Maria"],
    "Nueva Ecija": ["Aliaga", "Bongabon", "Cabanatuan City", "Cabiao", "Carranglan", "Cuyapo", "Gabaldon", "Gapan City", "General Mamerto Natividad", "General Tinio", "Guimba", "Jaen", "Laur", "Licab", "Llanera", "Lupao", "Muñoz City", "Nampicuan", "Palayan City", "Pantabangan", "Peñaranda", "Quezon", "Rizal", "San Antonio", "San Isidro", "San Jose City", "San Leonardo", "Santa Rosa", "Santo Domingo", "Talavera", "Talugtug", "Zaragoza"],
    "Pampanga": ["Angeles City", "Apalit", "Arayat", "Bacolor", "Candaba", "Floridablanca", "Guagua", "Lubao", "Mabalacat City", "Macabebe", "Magalang", "Masantol", "Mexico", "Minalin", "Porac", "San Fernando City", "San Luis", "San Simon", "Santa Ana", "Santa Rita", "Santo Tomas", "Sasmuan"],
    "Tarlac": ["Anao", "Bamban", "Camiling", "Capas", "Concepcion", "Gerona", "La Paz", "Mayantoc", "Moncada", "Paniqui", "Pura", "Ramos", "San Clemente", "San Jose", "San Manuel", "Santa Ignacia", "Tarlac City", "Victoria"],
    "Zambales": ["Botolan", "Cabangan", "Candelaria", "Castillejos", "Iba", "Masinloc", "Olongapo City", "Palauig", "San Antonio", "San Felipe", "San Marcelino", "San Narciso", "Santa Cruz", "Subic"],
    // Region-4A,
    "Batangas": ["Agoncillo", "Alitagtag", "Balayan", "Balete", "Bauan", "Calaca", "Calatagan", "Cuenca", "Ibaan", "Laurel", "Lemery", "Lian", "Lipa City", "Lobo", "Mabini", "Malvar", "Mataasnakahoy", "Nasugbu", "Padre Garcia", "Rosario", "San Jose", "San Juan", "San Luis", "San Nicolas", "San Pascual", "Santa Teresita", "Santo Tomas", "Taal", "Talisay", "Tanauan City", "Taysan", "Tingloy", "Tuy"],
    "Cavite": ["Alfonso", "Amadeo", "Bacoor City", "Carmona", "Cavite City", "Dasmariñas City", "General Emilio Aguinaldo", "General Mariano Alvarez", "General Trias City", "Imus City", "Indang", "Kawit", "Magallanes", "Maragondon", "Mendez", "Naic", "Noveleta", "Rosario", "Silang", "Tagaytay City", "Tanza", "Ternate", "Trece Martires City"],
    "Laguna": ["Alaminos", "Bay", "Biñan City", "Cabuyao City", "Calamba City", "Calauan", "Cavinti", "Famy", "Kalayaan", "Liliw", "Los Baños", "Luisiana", "Lumban", "Mabitac", "Magdalena", "Majayjay", "Nagcarlan", "Paete", "Pagsanjan", "Pakil", "Pangil", "Pila", "Rizal", "San Pablo City", "San Pedro City", "Santa Cruz", "Santa Maria", "Santa Rosa City", "Siniloan", "Victoria"],
    "Quezon": ["Agdangan", "Alabat", "Atimonan", "Buenavista", "Burdeos", "Calauag", "Candelaria", "Catanauan", "Dolores", "General Luna", "General Nakar", "Guinayangan", "Gumaca", "Infanta", "Jomalig", "Lopez", "Lucban", "Lucena City", "Macalelon", "Mauban", "Mulanay", "Padre Burgos", "Pagbilao", "Panukulan", "Patnanungan", "Perez", "Pitogo", "Plaridel", "Polillo", "Quezon", "Real", "Sampaloc", "San Andres", "San Antonio", "San Francisco", "San Narciso", "Sariaya", "Tagkawayan", "Tayabas City", "Tiaong", "Unisan"],
    "Rizal": ["Angono", "Baras", "Binangonan", "Cainta", "Cardona", "Jalajala", "Morong", "Pililla", "Rodriguez", "San Mateo", "Tanay", "Taytay", "Teresa"],
        // Region-4B, 
        "Marinduque": ["Boac", "Buenavista", "Gasan", "Mogpog", "Santa Cruz", "Torrijos"],
    "Occidental Mindoro": ["Abra de Ilog", "Calintaan", "Looc", "Lubang", "Magsaysay", "Mamburao", "Paluan", "Rizal", "Sablayan", "San Jose", "Santa Cruz"],
    "Oriental Mindoro": ["Baco", "Bansud", "Bongabong", "Bulalacao", "Calapan City", "Gloria", "Mansalay", "Naujan", "Pinamalayan", "Pola", "Puerto Galera", "Roxas", "San Teodoro", "Socorro", "Victoria"],
    "Palawan": ["Aborlan", "Agutaya", "Araceli", "Balabac", "Bataraza", "Brooke's Point", "Busuanga", "Cagayancillo", "Coron", "Culion", "Cuyo", "Dumaran", "El Nido", "Kalayaan", "Linapacan", "Magsaysay", "Narra", "Puerto Princesa City", "Quezon", "Rizal", "Roxas", "San Vicente", "Sofronio Española", "Taytay"],
    "Romblon": ["Alcantara", "Banton", "Cajidiocan", "Calatrava", "Concepcion", "Corcuera", "Ferrol", "Looc", "Magdiwang", "Odiongan", "Romblon", "San Agustin", "San Andres", "San Fernando", "San Jose", "Santa Fe", "Santa Maria"],
        //Region-5,
        "Albay": ["Bacacay", "Camalig", "Daraga", "Guinobatan", "Jovellar", "Legazpi City", "Libon", "Ligao City", "Malilipot", "Malinao", "Manito", "Oas", "Pio Duran", "Polangui", "Rapu-Rapu", "Santo Domingo", "Tabaco City", "Tiwi"],
    "Camarines Norte": ["Basud", "Capalonga", "Daet", "Jose Panganiban", "Labo", "Mercedes", "Paracale", "San Lorenzo Ruiz", "San Vicente", "Santa Elena", "Talisay", "Vinzons"],
    "Camarines Sur": ["Baao", "Balatan", "Bato", "Bombon", "Buhi", "Bula", "Cabusao", "Calabanga", "Camaligan", "Canaman", "Caramoan", "Del Gallego", "Gainza", "Garchitorena", "Goa", "Iriga City", "Lagonoy", "Libmanan", "Lupi", "Magarao", "Milaor", "Minalabac", "Nabua", "Naga City", "Ocampo", "Pamplona", "Pasacao", "Pili", "Presentacion", "Ragay", "Sagñay", "San Fernando", "San Jose", "Sipocot", "Siruma", "Tigaon", "Tinambac"],
    "Catanduanes": ["Bagamanoc", "Baras", "Bato", "Caramoran", "Gigmoto", "Pandan", "Panganiban", "San Andres", "San Miguel", "Viga", "Virac"],
    "Masbate": ["Aroroy", "Baleno", "Balud", "Batuan", "Cataingan", "Cawayan", "Claveria", "Dimasalang", "Esperanza", "Mandaon", "Masbate City", "Milagros", "Mobo", "Monreal", "Palanas", "Pio V. Corpuz", "Placer", "San Fernando", "San Jacinto", "San Pascual", "Uson"],
    "Sorsogon": ["Barcelona", "Bulan", "Bulusan", "Casiguran", "Castilla", "Donsol", "Gubat", "Irosin", "Juban", "Magallanes", "Matnog", "Pilar", "Prieto Diaz", "Santa Magdalena", "Sorsogon City"],
        //region6
        "Aklan": ["Altavas", "Balete", "Banga", "Batan", "Buruanga", "Ibajay", "Kalibo", "Lezo", "Libacao", "Madalag", "Makato", "Malay", "Malinao", "Nabas", "New Washington", "Numancia", "Tangalan"],
    "Antique": ["Anini-y", "Barbaza", "Belison", "Bugasong", "Caluya", "Culasi", "Hamtic", "Laua-an", "Libertad", "Pandan", "Patnongon", "San Jose", "San Remigio", "Sebaste", "Sibalom", "Tibiao", "Tobias Fornier", "Valderrama"],
    "Capiz": ["Cuartero", "Dao", "Dumalag", "Dumarao", "Ivisan", "Jamindan", "Maayon", "Mambusao", "Panay", "Panitan", "Pilar", "Pontevedra", "President Roxas", "Roxas City", "Sapian", "Sigma", "Tapaz"],
    "Guimaras": ["Buenavista", "Jordan", "Nueva Valencia", "San Lorenzo", "Sibunag"],
    "Iloilo": ["Ajuy", "Alimodian", "Anilao", "Badiangan", "Balasan", "Banate", "Barotac Nuevo", "Barotac Viejo", "Batad", "Bingawan", "Cabatuan", "Calinog", "Carles", "Concepcion", "Dingle", "Dueñas", "Dumangas", "Estancia", "Guimbal", "Igbaras", "Janiuay", "Lambunao", "Leganes", "Lemery", "Leon", "Maasin", "Miagao", "Mina", "New Lucena", "Oton", "Passi City", "Pavia", "Pototan", "San Dionisio", "San Enrique", "San Joaquin", "San Miguel", "San Rafael", "Santa Barbara", "Sara", "Tigbauan", "Tubungan", "Zarraga", "Iloilo City"],
    "Negros Occidental": ["Bacolod City", "Bago City", "Binalbagan", "Cadiz City", "Calatrava", "Candoni", "Cauayan", "Enrique B. Magalona", "Escalante City", "Himamaylan City", "Hinigaran", "Hinoba-an", "Ilog", "Isabela", "Kabankalan City", "La Carlota City", "La Castellana", "Manapla", "Moises Padilla", "Murcia", "Pontevedra", "Pulupandan", "Sagay City", "Salvador Benedicto", "San Carlos City", "San Enrique", "Silay City", "Sipalay City", "Talisay City", "Toboso", "Valladolid", "Victorias City"],
        //region7
        "Bohol": ["Alburquerque", "Alicia", "Anda", "Antequera", "Baclayon", "Balilihan", "Batuan", "Bien Unido", "Bilar", "Buenavista", "Calape", "Candijay", "Carmen", "Catigbian", "Clarin", "Corella", "Cortes", "Dagohoy", "Danao", "Dauis", "Dimiao", "Duero", "Garcia Hernandez", "Guindulman", "Inabanga", "Jagna", "Lila", "Loay", "Loboc", "Loon", "Mabini", "Maribojoc", "Panglao", "Pilar", "President Carlos P. Garcia", "Sagbayan", "San Isidro", "San Miguel", "Sevilla", "Sierra Bullones", "Sikatuna", "Tagbilaran City", "Talibon", "Trinidad", "Tubigon", "Ubay", "Valencia"],
    "Cebu": ["Alcantara", "Alcoy", "Alegria", "Aloguinsan", "Argao", "Asturias", "Badian", "Balamban", "Bantayan", "Barili", "Bogo City", "Boljoon", "Borbon", "Carcar City", "Carmen", "Catmon", "Cebu City", "Compostela", "Consolacion", "Cordoba", "Daanbantayan", "Dalaguete", "Danao City", "Dumanjug", "Ginatilan", "Lapu-Lapu City", "Liloan", "Madridejos", "Malabuyoc", "Mandaue City", "Medellin", "Minglanilla", "Moalboal", "Naga City", "Oslob", "Pilar", "Pinamungahan", "Poro", "Ronda", "Samboan", "San Fernando", "San Francisco", "San Remigio", "Santa Fe", "Santander", "Sibonga", "Sogod", "Tabogon", "Tabuelan", "Talisay City", "Toledo City", "Tuburan", "Tudela"],
    "Negros Oriental": ["Amlan", "Ayungon", "Bacong", "Bais City", "Basay", "Bayawan City", "Bindoy", "Canlaon City", "Dauin", "Dumaguete City", "Guihulngan City", "Jimalalud", "La Libertad", "Mabinay", "Manjuyod", "Pamplona", "San Jose", "Santa Catalina", "Siaton", "Sibulan", "Tanjay City", "Tayasan", "Valencia", "Vallehermoso", "Zamboanguita"],
    "Siquijor": ["Enrique Villanueva", "Larena", "Lazi", "Maria", "San Juan", "Siquijor"],
        //region8
        "Biliran": ["Almeria", "Biliran", "Cabucgayan", "Caibiran", "Culaba", "Kawayan", "Maripipi", "Naval"],
    "Eastern Samar": ["Arteche", "Balangiga", "Balangkayan", "Borongan City", "Can-avid", "Dolores", "General MacArthur", "Giporlos", "Guiuan", "Hernani", "Jipapad", "Lawaan", "Llorente", "Maslog", "Maydolong", "Mercedes", "Oras", "Quinapondan", "Salcedo", "San Julian", "San Policarpo", "Sulat", "Taft"],
    "Leyte": ["Abuyog", "Alangalang", "Albuera", "Babatngon", "Barugo", "Bato", "Baybay City", "Burauen", "Calubian", "Capoocan", "Carigara", "Dagami", "Dulag", "Hilongos", "Hindang", "Inopacan", "Isabel", "Jaro", "Javier", "Julita", "Kananga", "La Paz", "Leyte", "MacArthur", "Mahaplag", "Matag-ob", "Matalom", "Mayorga", "Merida", "Ormoc City", "Palo", "Palompon", "Pastrana", "San Isidro", "San Miguel", "Santa Fe", "Tabango", "Tabontabon", "Tacloban City", "Tanauan", "Tolosa", "Tunga", "Villaba"],
    "Northern Samar": ["Allen", "Biri", "Bobon", "Capul", "Catarman", "Catubig", "Gamay", "Laoang", "Lapinig", "Las Navas", "Lavezares", "Lope de Vega", "Mapanas", "Mondragon", "Palapag", "Pambujan", "Rosario", "San Antonio", "San Isidro", "San Jose", "San Roque", "San Vicente", "Silvino Lobos", "Victoria"],
    "Samar": ["Almagro", "Basey", "Calbayog City", "Calbiga", "Catbalogan City", "Daram", "Gandara", "Hinabangan", "Jiabong", "Marabut", "Matuguinao", "Motiong", "Pagsanghan", "Paranas", "Pinabacdao", "San Jorge", "San Jose de Buan", "San Sebastian", "Santa Margarita", "Santa Rita", "Santo Niño", "Tagapul-an", "Talalora", "Tarangnan", "Villareal", "Zumarraga"],
    "Southern Leyte": ["Anahawan", "Bontoc", "Hinunangan", "Hinundayan", "Libagon", "Liloan", "Limasawa", "Maasin City", "Macrohon", "Malitbog", "Padre Burgos", "Pintuyan", "Saint Bernard", "San Francisco", "San Juan", "San Ricardo", "Silago", "Sogod", "Tomas Oppus"],
        //region9
        "Zamboanga del Norte": ["Baliguian", "Dapitan City", "Dipolog City", "Godod", "Gutalac", "Jose Dalman", "Kalawit", "Katipunan", "La Libertad", "Labason", "Liloy", "Manukan", "Mutia", "Piñan", "Polanco", "Rizal", "Roxas", "Salug", "Sergio Osmeña Sr.", "Siayan", "Sibuco", "Sibutad", "Sindangan", "Siocon", "Sirawai", "Tampilisan"],
    "Zamboanga del Sur": ["Aurora", "Bayog", "Dimataling", "Dinas", "Dumalinao", "Dumingag", "Guipos", "Josefina", "Kumalarang", "Labangan", "Lakewood", "Lapuyan", "Mahayag", "Margosatubig", "Midsalip", "Molave", "Pagadian City", "Pitogo", "Ramon Magsaysay", "San Miguel", "San Pablo", "Sominot", "Tabina", "Tambulig", "Tigbao", "Tukuran", "Vincenzo A. Sagun"],
    "Zamboanga Sibugay": ["Alicia", "Buug", "Diplahan", "Imelda", "Ipil", "Kabasalan", "Mabuhay", "Malangas", "Naga", "Olutanga", "Payao", "Roseller Lim", "Siay", "Talusan", "Titay", "Tungawan"],
        //region10
        "Bukidnon": ["Baungon", "Cabanglasan", "Damulog", "Dangcagan", "Don Carlos", "Impasugong", "Kadingilan", "Kalilangan", "Kibawe", "Kitaotao", "Lantapan", "Libona", "Malaybalay City", "Malitbog", "Manolo Fortich", "Maramag", "Pangantucan", "Quezon", "San Fernando", "Sumilao", "Talakag", "Valencia City"],
    "Camiguin": ["Catarman", "Guinsiliban", "Mahinog", "Mambajao", "Sagay"],
    "Lanao del Norte": ["Bacolod", "Baloi", "Baroy", "Kapatagan", "Kauswagan", "Kolambugan", "Lala", "Linamon", "Magsaysay", "Maigo", "Matungao", "Munai", "Nunungan", "Pantao Ragat", "Pantar", "Poona Piagapo", "Salvador", "Sapad", "Sultan Naga Dimaporo", "Tagoloan", "Tangcal", "Tubod"],
    "Misamis Occidental": ["Aloran", "Baliangao", "Bonifacio", "Calamba", "Clarin", "Concepcion", "Don Victoriano Chiongbian", "Jimenez", "Lopez Jaena", "Oroquieta City", "Ozamiz City", "Panaon", "Plaridel", "Sapang Dalaga", "Sinacaban", "Tangub City", "Tudela"],
    "Misamis Oriental": ["Alubijid", "Balingasag", "Balingoan", "Binuangan", "Cagayan de Oro City", "Claveria", "El Salvador City", "Gingoog City", "Gitagum", "Initao", "Jasaan", "Kinoguitan", "Lagonglong", "Laguindingan", "Libertad", "Lugait", "Magsaysay", "Manticao", "Medina", "Naawan", "Opol", "Salay", "Sugbongcogon", "Tagoloan", "Talisayan", "Villanueva"],
        //region11
        "Davao de Oro": ["Compostela", "Laak", "Mabini", "Maco", "Maragusan", "Mawab", "Monkayo", "Montevista", "Nabunturan", "New Bataan", "Pantukan"],
    "Davao del Norte": ["Asuncion", "Braulio E. Dujali", "Carmen", "Kapalong", "New Corella", "Panabo City", "Samal City", "San Isidro", "Santo Tomas", "Tagum City", "Talaingod"],
    "Davao del Sur": ["Bansalan", "Davao City", "Digos City", "Hagonoy", "Kiblawan", "Magsaysay", "Malalag", "Matanao", "Padada", "Santa Cruz", "Sulop"],
    "Davao Occidental": ["Don Marcelino", "Jose Abad Santos", "Malita", "Santa Maria", "Sarangani"],
    "Davao Oriental": ["Baganga", "Banaybanay", "Boston", "Caraga", "Cateel", "Governor Generoso", "Lupon", "Manay", "Mati City", "San Isidro", "Tarragona"],
        //region12
        "Cotabato": ["Alamada", "Aleosan", "Antipas", "Arakan", "Banisilan", "Carmen", "Kabacan", "Kidapawan City", "Libungan", "Magpet", "Makilala", "Matalam", "Midsayap", "Pigkawayan", "Pikit", "President Roxas", "Tulunan"],
    "Sarangani": ["Alabel", "Glan", "Kiamba", "Maasim", "Maitum", "Malapatan", "Malungon"],
    "South Cotabato": ["Banga", "General Santos City", "Koronadal City", "Lake Sebu", "Norala", "Polomolok", "Santo Niño", "Surallah", "Tampakan", "Tantangan", "T'boli", "Tupi"],
    "Sultan Kudarat": ["Bagumbayan", "Columbio", "Esperanza", "Isulan", "Kalamansig", "Lambayong", "Lebak", "Lutayan", "Palimbang", "President Quirino", "Senator Ninoy Aquino", "Tacurong City"],
        //region13
        "Agusan del Norte": ["Buenavista", "Butuan City", "Cabadbaran City", "Carmen", "Jabonga", "Kitcharao", "Las Nieves", "Magallanes", "Nasipit", "Remedios T. Romualdez", "Santiago", "Tubay"],
    "Agusan del Sur": ["Bayugan City", "Bunawan", "Esperanza", "La Paz", "Loreto", "Prosperidad", "Rosario", "San Francisco", "San Luis", "Santa Josefa", "Sibagat", "Talacogon", "Trento", "Veruela"],
    "Dinagat Islands": ["Basilisa", "Cagdianao", "Dinagat", "Libjo", "Loreto", "San Jose", "Tubajon"],
    "Surigao del Norte": ["Alegria", "Bacuag", "Burgos", "Claver", "Dapa", "Del Carmen", "General Luna", "Gigaquit", "Mainit", "Malimono", "Pilar", "Placer", "San Benito", "San Francisco", "San Isidro", "Santa Monica", "Sison", "Socorro", "Surigao City", "Tagana-an", "Tubod"],
    "Surigao del Sur": ["Barobo", "Bayabas", "Bislig City", "Cagwait", "Cantilan", "Carmen", "Carrascal", "Cortes", "Hinatuan", "Lanuza", "Lianga", "Lingig", "Madrid", "Marihatag", "San Agustin", "San Miguel", "Tagbina", "Tago", "Tandag City"],
};



    // Load statistics on page load if statistics tab is active (with delay to ensure functions are loaded)
    setTimeout(() => {
        if (document.querySelector('.tab[data-tab="statistics"]')?.classList.contains('active')) {
            if (typeof initializeChartsWithData === 'function') {
                initializeChartsWithData();
            }
        }
    }, 500);

    function showMessage(text, type) {
        const message = document.getElementById('message');
        message.textContent = text;
        message.className = `message rounded-lg px-4 py-3 mb-6 text-center font-semibold ${type === 'success' ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200'}`;
        message.classList.remove('hidden');
        
        message.scrollIntoView({ behavior: 'smooth' });
        
        setTimeout(() => {
            message.textContent = '';
            message.className = 'message hidden';
        }, 5000);
    }

    // Image preview functionality for add form
    document.getElementById('images').addEventListener('change', function() {
        const files = this.files;
        const previewDiv = document.getElementById('image-preview');
        previewDiv.innerHTML = '';

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'preview-image rounded-lg border border-gray-300 p-1';
                previewDiv.appendChild(img);
            }
            reader.readAsDataURL(file);
        }

        document.getElementById('remove-image').classList.remove('hidden');
    });

    document.getElementById('remove-image').addEventListener('click', function() {
        document.getElementById('images').value = '';
        document.getElementById('image-preview').innerHTML = '';
        this.classList.add('hidden');
    });

    // Image preview functionality for edit form
    document.getElementById('edit-new-images').addEventListener('change', function() {
        const files = this.files;
        const previewDiv = document.getElementById('edit-image-preview');
        previewDiv.innerHTML = '';

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'preview-image rounded-lg border border-gray-300 p-1';
                previewDiv.appendChild(img);
            }
            reader.readAsDataURL(file);
        }

        document.getElementById('remove-edit-image').classList.remove('hidden');
    });

    document.getElementById('remove-edit-image').addEventListener('click', function() {
        document.getElementById('edit-new-images').value = '';
        document.getElementById('edit-image-preview').innerHTML = '';
        this.classList.add('hidden');
    });

    // Load spots function with search and category filter support
    function loadSpots(searchTerm = '', categoryFilter = '') {
        const params = new URLSearchParams();
        if (searchTerm) params.append('search', searchTerm);
        if (categoryFilter) params.append('category', categoryFilter);
        
        const queryString = params.toString();
        const url = queryString ? `get_spots.php?${queryString}` : 'get_spots.php';
        
        fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const spotsList = document.getElementById('spots-list');
            spotsList.innerHTML = ''; 
            
            if (data.error) {
                spotsList.innerHTML = `<tr><td colspan="5" class="px-6 py-4 text-center text-red-600">${data.error}</td></tr>`;
                return;
            }
            
            if (!Array.isArray(data) || data.length === 0) {
                spotsList.innerHTML = '<tr><td colspan="5" class="px-6 py-4 text-center text-gray-600">No spots found</td></tr>';
                return;
            }
            
            data.forEach(spot => {
                const address = `
                    <strong>Region:</strong> ${spot.region || 'N/A'}<br>
                    <strong>Province:</strong> ${spot.province || 'N/A'}<br>
                    <strong>Municipality:</strong> ${spot.municipality || 'N/A'}
                `;

                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50 transition-colors duration-200';
                row.innerHTML = `
                    <td class="px-6 py-4">${spot.id}</td>
                    <td class="px-6 py-4 font-medium">${spot.name || 'N/A'}</td>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-1">
                            ${(spot.category || 'N/A').split(',').map(cat => 
                                `<span class="inline-block px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded">${cat.trim()}</span>`
                            ).join('')}
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm">${address}</td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <button class="edit-btn px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md" data-id="${spot.id}">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </button>
                            <button class="delete-btn px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md" data-id="${spot.id}" data-name="${spot.name}">
                                <i class="fas fa-trash mr-1"></i> Delete
                            </button>
                        </div>
                    </td>
                `;
                spotsList.appendChild(row);
            });
            
            addButtonListeners();
        })
        .catch(error => {
            console.error('Error:', error);
            const spotsList = document.getElementById('spots-list');
            spotsList.innerHTML = `<tr><td colspan="5" class="px-6 py-4 text-center text-red-600">Error loading spots: ${error.message}</td></tr>`;
            showMessage('Error loading spots data: ' + error.message, 'error');
        });
    }

    function addButtonListeners() {
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const spotId = this.dataset.id;
                editSpot(spotId);
            });
        });
        
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const spotId = this.dataset.id;
                if (confirm(`Are you sure you want to delete "${this.dataset.name}"?`)) {
                    deleteSpot(spotId);
                }
            });
        });
    }

function editSpot(id) {
    // Scroll to top immediately
    window.scrollTo({ top: 0, behavior: 'smooth' });
    
    fetch(`get_spot.php?id=${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(spot => {
            if (spot.error) {
                throw new Error(spot.error);
            }
            
            // Clear edit image preview
            document.getElementById('edit-image-preview').innerHTML = '';
            document.getElementById('remove-edit-image').classList.add('hidden');
            document.getElementById('edit-new-images').value = '';
            
            // Populate basic fields
            document.getElementById('edit-id').value = spot.id;
            document.getElementById('edit-name').value = spot.name || '';
            
            // Handle multiple categories
            const categoriesSelect = document.getElementById('edit-categories');
            if (categoriesSelect && spot.category) {
                Array.from(categoriesSelect.options).forEach(option => {
                    option.selected = false;
                });
                
                const categories = spot.category.split(',').map(cat => cat.trim());
                
                Array.from(categoriesSelect.options).forEach(option => {
                    if (categories.includes(option.value)) {
                        option.selected = true;
                    }
                });
            }
            
            // Populate other fields
            document.getElementById('edit-safety_level').value = spot.safety_level || 'safe';
            document.getElementById('edit-annual_visitors').value = spot.annual_visitors || 0;
            document.getElementById('edit-overview').value = spot.overview || '';
            document.getElementById('edit-things_to_do').value = spot.things_to_do || '';
            document.getElementById('edit-operating_hours').value = spot.operating_hours || '';
            document.getElementById('edit-nearby_accommodations').value = spot.nearby_accommodations || '';
            document.getElementById('edit-nearby_restaurants').value = spot.nearby_restaurants || '';
            document.getElementById('edit-contact_information').value = spot.contact_information || '';
            document.getElementById('edit-official_links').value = spot.official_links || '';
            document.getElementById('edit-transportation').value = spot.transportation || '';
            
            // Location fields
            document.getElementById('edit-region').value = spot.region || '';
            
            // Local Languages field
            document.getElementById('edit-local_languages').value = spot.local_languages || '';
            
            // GPS Coordinates fields
            const latField = document.getElementById('edit-latitude');
            const lngField = document.getElementById('edit-longitude');
            
            if (latField && lngField) {
                latField.value = spot.latitude || 0;
                lngField.value = spot.longitude || 0;
            }
            
            // Handle images and owners
            const currentImagesContainer = document.getElementById('current-images-container');
            const imageOwnersContainer = document.getElementById('image-owners-container');
            
            if (currentImagesContainer) {
                currentImagesContainer.innerHTML = '';
            }
            if (imageOwnersContainer) {
                imageOwnersContainer.innerHTML = '';
            }
            
            if (spot.images && spot.images.length > 0) {
                spot.images.forEach((image, index) => {
                    const imageId = spot.image_ids[index] || `temp_${index}`;
                    const ownerName = spot.image_owners[index] || 'Unknown';
                    
                    if (currentImagesContainer) {
                        const imageDiv = document.createElement('div');
                        imageDiv.className = 'relative inline-block mr-4 mb-4';
                        imageDiv.innerHTML = `
                            <img src="${image}" class="w-32 h-24 object-cover rounded-lg border border-gray-300" alt="Current Image">
                            <button type="button" class="delete-image-btn absolute -top-2 -right-2 bg-red-500 hover:bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold shadow-lg transition-all" 
                                    data-image-id="${imageId}" 
                                    data-image-path="${image}" 
                                    title="Delete Image">×</button>
                            <div class="text-xs text-center mt-1 text-gray-600">Image ${index + 1}</div>
                        `;
                        currentImagesContainer.appendChild(imageDiv);
                    }
                    
                    if (imageOwnersContainer) {
                        const ownerDiv = document.createElement('div');
                        ownerDiv.className = 'flex items-center gap-2 mb-2';
                        ownerDiv.innerHTML = `
                            <span class="text-sm font-medium w-20 flex-shrink-0">Image ${index + 1}:</span>
                            <input type="text" name="image_owners[${imageId}]" 
                                   value="${ownerName}" 
                                   class="flex-1 px-3 py-2 border border-gray-300 rounded text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                   placeholder="Owner name">
                        `;
                        imageOwnersContainer.appendChild(ownerDiv);
                    }
                });
            } else {
                if (currentImagesContainer) {
                    currentImagesContainer.innerHTML = '<p class="text-gray-500 italic">No images found.</p>';
                }
                if (imageOwnersContainer) {
                    imageOwnersContainer.innerHTML = '<p class="text-gray-500 italic">No image owners.</p>';
                }
            }
            
            // Load provinces and municipalities
            loadProvinces('edit');
            setTimeout(() => {
                const provinceSelect = document.getElementById('edit-province');
                if (provinceSelect) {
                    provinceSelect.value = spot.province || '';
                    loadMunicipalities('edit');
                    setTimeout(() => {
                        const municipalitySelect = document.getElementById('edit-municipality');
                        if (municipalitySelect) {
                            municipalitySelect.value = spot.municipality || '';
                        }
                    }, 100);
                }
            }, 100);
            
            // Show edit form at top
// Show edit form at top
            const editForm = document.getElementById('edit-form');
            if (editForm) {
                // Reset button states before showing form
                const submitBtn = editForm.querySelector('button[type="submit"]');
                const cancelBtn = document.getElementById('cancel-edit');
                if (submitBtn) {
                    submitBtn.innerHTML = '<i class="fas fa-save mr-3 text-gold"></i> Update Spot';
                    submitBtn.disabled = false;
                }
                if (cancelBtn) {
                    cancelBtn.disabled = false;
                }

                editForm.classList.remove('hidden');
                setTimeout(() => {
                    editForm.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 300);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showMessage('Error loading spot data: ' + error.message, 'error');
        });
}

    // Edit form submission
// Edit form submission
document.getElementById('edit-form').addEventListener('submit', function (e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    const categoriesSelect = document.getElementById('edit-categories');
    const selectedCategories = Array.from(categoriesSelect.selectedOptions).map(option => option.value);
    
    if (selectedCategories.length === 0) {
        showMessage('Please select at least one category', 'error');
        return;
    }
    
    formData.delete('categories[]');
    formData.delete('category');
    selectedCategories.forEach(category => {
        formData.append('categories[]', category);
    });
    
    const safetyLevel = document.getElementById('edit-safety_level').value;
    formData.set('safety_level', safetyLevel);
    
    if (!['safe', 'caution', 'dangerous'].includes(safetyLevel)) {
        showMessage('Please select a valid safety level', 'error');
        return;
    }
    
    const submitBtn = this.querySelector('button[type="submit"]');
    const cancelBtn = document.getElementById('cancel-edit');
    const originalText = submitBtn.innerHTML;
    
    // Disable both buttons during submission
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Updating...';
    submitBtn.disabled = true;
    cancelBtn.disabled = true;
    
    fetch('update_spot.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Re-enable buttons
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        cancelBtn.disabled = false;
        
        if (data.success) {
            showMessage(data.message, 'success');
            document.getElementById('edit-form').classList.add('hidden');
            // Reload with current filters
            const searchTerm = document.getElementById('search-input').value.trim();
            const categoryFilter = document.getElementById('category-filter').value;
            loadSpots(searchTerm, categoryFilter);
        } else {
            showMessage(data.message, 'error');
        }
        window.scrollTo(0, 0);
    })
    .catch(error => {
        console.error('Error:', error);
        // Re-enable buttons on error
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        cancelBtn.disabled = false;
        showMessage('Error updating spot: ' + error.message, 'error');
        window.scrollTo(0, 0);
    });
});

    // Add spot form submission
    document.getElementById('add-spot-form').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        
        const categoriesSelect = document.getElementById('categories');
        const selectedCategories = Array.from(categoriesSelect.selectedOptions).map(option => option.value);
        
        if (selectedCategories.length === 0) {
            showMessage('Please select at least one category', 'error');
            return;
        }
        
        formData.delete('categories[]');
        formData.delete('category');
        
        selectedCategories.forEach(category => {
            formData.append('categories[]', category);
        });
        
        formData.append('image_owners', document.getElementById('image_owners').value);
        
        fetch('add_spot.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(message => {
            showMessage(message, 'success');
            this.reset(); 
            document.getElementById('image-preview').innerHTML = '';
            window.scrollTo(0, 0);
        })
        .catch(error => {
            console.error('Error:', error);
            showMessage('An error occurred. Please try again.', 'error');
            window.scrollTo(0, 0);
        });
    });

    // Delete image button handler
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-image-btn')) {
            e.preventDefault();
            e.stopPropagation();
            
            const imageId = e.target.dataset.imageId;
            const imagePath = e.target.dataset.imagePath;
            const spotId = document.getElementById('edit-id').value;

            if (confirm('Are you sure you want to delete this image? This action cannot be undone.')) {
                e.target.disabled = true;
                e.target.innerHTML = '...';
                
                fetch('delete_image.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `spot_id=${encodeURIComponent(spotId)}&image_id=${encodeURIComponent(imageId)}&image_path=${encodeURIComponent(imagePath)}`
                })
                .then(response => response.text())
                .then(message => {
                    showMessage('Image deleted successfully!', 'success');
                    editSpot(spotId);
                })
                .catch(error => {
                    console.error('Error:', error);
                    showMessage('Error deleting image. Please try again.', 'error');
                    e.target.disabled = false;
                    e.target.innerHTML = '×';
                });
            }
        }
    });

    // Cancel edit button
// Cancel edit button - COMPLETE VERSION
document.getElementById('cancel-edit').addEventListener('click', function() {
    const editForm = document.getElementById('edit-form');
    const submitBtn = editForm.querySelector('button[type="submit"]');
    const cancelBtn = this;
    
    // FORCE reset button states
    if (submitBtn) {
        submitBtn.innerHTML = '<i class="fas fa-save mr-3 text-gold"></i> Update Spot';
        submitBtn.disabled = false;
        submitBtn.removeAttribute('disabled');
    }
    if (cancelBtn) {
        cancelBtn.disabled = false;
        cancelBtn.removeAttribute('disabled');
    }
    
    // Hide form
    editForm.classList.add('hidden');
    
    // Scroll to table
    document.getElementById('spots-table-container').scrollIntoView({ behavior: 'smooth', block: 'start' });
});

    // Delete spot function
    function deleteSpot(id) {
        fetch('delete_spot.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `spot_id=${id}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showMessage(data.message, 'success');
                // Reload with current filters
                const searchTerm = document.getElementById('search-input').value.trim();
                const categoryFilter = document.getElementById('category-filter').value;
                loadSpots(searchTerm, categoryFilter);
            } else {
                showMessage(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showMessage('Error deleting spot', 'error');
        });
    }

    // Search button
    document.getElementById('search-button').addEventListener('click', function() {
        const searchTerm = document.getElementById('search-input').value.trim();
        const categoryFilter = document.getElementById('category-filter').value;
        loadSpots(searchTerm, categoryFilter);
    });

    // Category filter
    document.getElementById('category-filter').addEventListener('change', function() {
        const searchTerm = document.getElementById('search-input').value.trim();
        const categoryFilter = this.value;
        loadSpots(searchTerm, categoryFilter);
    });

    // Clear filters button
    document.getElementById('clear-filters').addEventListener('click', function() {
        document.getElementById('search-input').value = '';
        document.getElementById('category-filter').value = '';
        loadSpots();
    });

    // Search on Enter key
    document.getElementById('search-input').addEventListener('keyup', function(e) {
        if (e.key === 'Enter') {
            const searchTerm = this.value.trim();
            const categoryFilter = document.getElementById('category-filter').value;
            loadSpots(searchTerm, categoryFilter);
        }
    });

    // Load spots on page load if manage tab is active
    if (document.querySelector('.tab[data-tab="manage"]').classList.contains('active')) {
        loadSpots();
    }

    // Load users function
    function loadUsers() {
        fetch('get_users.php')
        .then(response => response.json())
        .then(users => {
            const table = document.getElementById('users-table').querySelector('tbody');
            table.innerHTML = users.map(user => `
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">${user.id}</td>
                    <td class="px-6 py-4">${user.username}</td>
                    <td class="px-6 py-4">${user.email}</td>
                    <td class="px-6 py-4">
                        <button onclick="deleteUser(${user.id})" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-lg transition">
                            Delete
                        </button>
                    </td>
                </tr>
            `).join('');
        })
        .catch(error => {
            console.error('Error loading users:', error);
            showMessage('Error loading users', 'error');
        });
    }

    // Load ratings function
    function loadRatings() {
        fetch('get_ratings.php')
        .then(response => response.json())
        .then(ratings => {
            const table = document.getElementById('ratings-table').querySelector('tbody');
            table.innerHTML = ratings.map(rating => `
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">${rating.id}</td>
                    <td class="px-6 py-4">${rating.username}</td>
                    <td class="px-6 py-4">${rating.spot_name}</td>
                    <td class="px-6 py-4">${rating.rating}</td>
                    <td class="px-6 py-4">${rating.comment}</td>
                    <td class="px-6 py-4">
                        <button onclick="deleteRating(${rating.id})" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-lg transition">
                            Delete
                        </button>
                    </td>
                </tr>
            `).join('');
        })
        .catch(error => {
            console.error('Error loading ratings:', error);
            showMessage('Error loading ratings', 'error');
        });
    }

// Global functions for inline onclick handlers and form onchange attributes


function deleteRating(ratingId) {
    if (confirm('Are you sure you want to delete this rating?')) {
        fetch('delete_rating.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id=${ratingId}`
        })
        .then(response => response.text())
        .then(message => {
            alert(message);
            document.querySelector('.tab[data-tab="ratings"]').click();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting rating.');
        });
    }
}

function deleteUser(userId) {
    if (confirm('Are you sure you want to delete this user?')) {
        fetch('delete_user.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id=${userId}`
        })
        .then(() => document.querySelector('.tab[data-tab="users"]').click())
        .catch(error => console.error('Error:', error));
    }
}

function populateOwnerFields(spot) {
    const ownersContainer = document.getElementById('current-owners-container');
    ownersContainer.innerHTML = '';
    
    if (spot.owners && spot.owners.length > 0) {
        spot.owners.forEach((owner, index) => {
            const ownerDiv = document.createElement('div');
            ownerDiv.className = 'mb-2';
            ownerDiv.innerHTML = `
                <label class="block text-sm font-medium text-gray-700">Owner for Image ${index + 1}:</label>
                <input type="hidden" name="image_ids[]" value="${spot.image_ids[index]}">
                <input type="text" name="owner_names[]" value="${owner || ''}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md">
            `;
            ownersContainer.appendChild(ownerDiv);
        });
    }
}
// Load featured spots
function loadFeaturedSpots(searchTerm = '') {
    const url = searchTerm ? `get_all_spots.php?search=${encodeURIComponent(searchTerm)}` : 'get_all_spots.php';
    
    fetch(url)
    .then(response => {
        // Check if response is JSON
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            throw new TypeError('Server returned non-JSON response');
        }
        return response.json();
    })
    .then(data => {
        const featuredList = document.getElementById('featured-spots-list');
        featuredList.innerHTML = '';
        
        if (data.error) {
            showMessage('Error loading spots: ' + data.error, 'error');
            return;
        }
        
        if (data.length === 0) {
            featuredList.innerHTML = '<tr><td colspan="5" class="px-6 py-4 text-center">No spots found</td></tr>';
            return;
        }
        
        data.forEach(spot => {
            const row = document.createElement('tr');
            row.className = 'hover:bg-gray-50';
            row.innerHTML = `
                <td class="px-6 py-4 text-center">
                    <input type="checkbox" class="featured-checkbox h-5 w-5 text-primary-600 focus:ring-primary-500 border-gray-300 rounded" 
                           data-id="${spot.id}" ${spot.featured == 1 ? 'checked' : ''}>
                </td>
                <td class="px-6 py-4">${spot.id}</td>
                <td class="px-6 py-4">${spot.name}</td>
                <td class="px-6 py-4">${spot.category}</td>
                <td class="px-6 py-4">${spot.annual_visitors || 0}</td>
            `;
            featuredList.appendChild(row);
        });
        
        // Add event listeners to checkboxes
        addCheckboxListeners();
    })
    .catch(error => {
        console.error('Error:', error);
        showMessage('Error loading spots data: ' + error.message, 'error');
    });
}

// Add event listeners to checkboxes
function addCheckboxListeners() {
    document.querySelectorAll('.featured-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Visual feedback when checkbox changes
            this.parentElement.classList.toggle('bg-green-50', this.checked);
        });
        
        // Set initial state
        if (checkbox.checked) {
            checkbox.parentElement.classList.add('bg-green-50');
        }
    });
}

// Save featured spots
document.getElementById('save-featured-btn').addEventListener('click', function() {
    const featuredCheckboxes = document.querySelectorAll('.featured-checkbox:checked');
    const featuredIds = Array.from(featuredCheckboxes).map(checkbox => parseInt(checkbox.dataset.id));
    
    // Limit to 12 featured spots
    if (featuredIds.length > 100) {
        showMessage('You can only select up to 100 featured spots', 'error');
        return;
    }
    
    // Create form data to send
    const formData = new FormData();
    formData.append('featured_ids', JSON.stringify(featuredIds));
    
    // Show loading state
    const saveBtn = document.getElementById('save-featured-btn');
    const originalText = saveBtn.innerHTML;
    saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Saving...';
    saveBtn.disabled = true;
    
    fetch('update_featured.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        // Check if response is JSON
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            throw new TypeError('Server returned non-JSON response');
        }
        return response.json();
    })
    .then(data => {
        // Restore button state
        saveBtn.innerHTML = originalText;
        saveBtn.disabled = false;
        
        if (data.success) {
            showMessage(data.message, 'success');
            // Don't reload the data immediately, keep the current checkbox states
            // Instead, just update the visual feedback
            updateCheckboxVisuals();
        } else {
            showMessage(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Restore button state
        saveBtn.innerHTML = originalText;
        saveBtn.disabled = false;
        showMessage('Error updating featured spots: ' + error.message, 'error');
    });
});

function updateCheckboxVisuals() {
    document.querySelectorAll('.featured-checkbox').forEach(checkbox => {
        if (checkbox.checked) {
            checkbox.parentElement.classList.add('bg-green-50');
        } else {
            checkbox.parentElement.classList.remove('bg-green-50');
        }
    });
}

const style = document.createElement('style');
style.textContent = `
    .bg-green-50 {
        background-color: #f0fdf4;
    }
    .featured-checkbox:checked + label {
        font-weight: bold;
    }
`;
document.head.appendChild(style);

// Search functionality for featured spots
document.getElementById('featured-search-btn').addEventListener('click', function() {
    const searchTerm = document.getElementById('featured-search').value.trim();
    loadFeaturedSpots(searchTerm);
});

document.getElementById('featured-clear-search').addEventListener('click', function() {
    document.getElementById('featured-search').value = '';
    loadFeaturedSpots();
});

document.getElementById('featured-search').addEventListener('keyup', function(e) {
    if (e.key === 'Enter') {
        const searchTerm = this.value.trim();
        loadFeaturedSpots(searchTerm);
    }
});

// Add event listener for the featured tab
document.querySelector('.tab[data-tab="featured"]').addEventListener('click', function() {
    loadFeaturedSpots();
});
function showMessage(text, type) {
    const message = document.getElementById('message');
    message.textContent = text;
    message.className = `message rounded-lg px-4 py-3 mb-6 text-center font-semibold ${type === 'success' ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200'}`;
    message.classList.remove('hidden');
    
    message.scrollIntoView({ behavior: 'smooth' });
    
    setTimeout(() => {
        message.textContent = '';
        message.className = 'message hidden';
    }, 5000);
}

document.getElementById('logout-btn').addEventListener('click', function() {
    if (confirm('Are you sure you want to logout?')) {
        fetch('admin_logout.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = 'admin_login_form.php';
                }
            })
            .catch(error => {
                console.error('Logout error:', error);
                window.location.href = 'admin_login_form.php';
            });
    }
});






            // Create or select position pin buttons


// ========================================
// MAP VARIABLES
// ========================================
let adminMap = null;
let adminMarker = null;
let currentFormType = 'add';
let selectedLatLng = null;

// Modal elements
const modal = document.getElementById('position-pin-modal');
const closeBtn = document.getElementById('close-position-modal');
const saveBtn = document.getElementById('save-position-btn');
const currentLat = document.getElementById('current-lat');
const currentLng = document.getElementById('current-lng');
const addPositionPinBtn = document.getElementById('position-pin-btn');
const editPositionPinBtn = document.getElementById('edit-position-pin-btn');

// ========================================
// DROPDOWN POPULATION FUNCTIONS
// ========================================
function loadProvinces(formType = 'add') {
    const prefix = formType === 'add' ? '' : 'edit-';
    const regionSelect = document.getElementById(prefix + 'region');
    const provinceSelect = document.getElementById(prefix + 'province');
    const municipalitySelect = document.getElementById(prefix + 'municipality');
    
    console.log('🔄 loadProvinces called:', formType);
    
    if (!regionSelect || !provinceSelect) {
        console.error('❌ Elements not found');
        return false;
    }

    const selectedRegion = regionSelect.value;
    console.log('   Region:', selectedRegion);

    // Clear dropdowns
    provinceSelect.innerHTML = '<option value="" disabled selected>📍 Select Province</option>';
    if (municipalitySelect) {
        municipalitySelect.innerHTML = '<option value="" disabled selected>🏘️ Select Municipality</option>';
    }

    // Populate provinces
    if (selectedRegion && typeof regions !== 'undefined' && regions[selectedRegion]) {
        const provinceList = regions[selectedRegion];
        console.log(`   Loading ${provinceList.length} provinces`);
        
        provinceList.forEach(province => {
            const option = document.createElement('option');
            option.value = province;
            option.textContent = province;
            provinceSelect.appendChild(option);
        });
        
        console.log('✅ Loaded', provinceSelect.options.length - 1, 'provinces');
        return true;
    }
    
    console.error('❌ No province data for region:', selectedRegion);
    return false;
}

function loadMunicipalities(formType = 'add') {
    const prefix = formType === 'add' ? '' : 'edit-';
    const provinceSelect = document.getElementById(prefix + 'province');
    const municipalitySelect = document.getElementById(prefix + 'municipality');
    
    console.log('🔄 loadMunicipalities called:', formType);
    
    if (!provinceSelect || !municipalitySelect) {
        console.error('❌ Elements not found');
        return false;
    }

    const selectedProvince = provinceSelect.value;
    console.log('   Province:', selectedProvince);

    // Clear municipalities
    municipalitySelect.innerHTML = '<option value="" disabled selected>🏘️ Select Municipality</option>';

    // Populate municipalities
    if (selectedProvince && typeof provinces !== 'undefined' && provinces[selectedProvince]) {
        const municipalityList = provinces[selectedProvince];
        console.log(`   Loading ${municipalityList.length} municipalities`);
        
        municipalityList.forEach(municipality => {
            const option = document.createElement('option');
            option.value = municipality;
            option.textContent = municipality;
            municipalitySelect.appendChild(option);
        });
        
        console.log('✅ Loaded', municipalitySelect.options.length - 1, 'municipalities');
        return true;
    }
    
    console.error('❌ No municipality data for province:', selectedProvince);
    return false;
}

// ========================================
// MAP FUNCTIONS
// ========================================
function initializeAdminMap() {
    if (adminMap) {
        adminMap.remove();
    }
    
    const philippinesCenter = [12.8797, 121.7740];
    
    // Define Philippines boundaries
    const philippinesBounds = [
        [4.6, 116.0],    // Southwest corner
        [21.0, 126.6]    // Northeast corner
    ];
    
    adminMap = L.map('admin-leaflet-map', {
        center: philippinesCenter,
        zoom: 6,
        minZoom: 5,
        maxZoom: 18,
        zoomControl: true,
        maxBounds: philippinesBounds,           // Restrict panning to these bounds
        maxBoundsViscosity: 1.0,                // Prevent dragging beyond bounds
        wheelPxPerZoomLevel: 60                 // Smoother zoom with mouse wheel
    });
    
    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/">CARTO</a>',
        subdomains: 'abcd',
        maxZoom: 20
    }).addTo(adminMap);
    
    // Set the map view to fit within Philippines bounds on load
    adminMap.fitBounds(philippinesBounds);
    
    adminMap.on('click', function(e) {
        placeAdminMarker(e.latlng);
    });
    
    console.log('✅ Map initialized with Philippines bounds locked');
}

function createAdminMarkerIcon() {
    return L.divIcon({
        className: 'admin-custom-marker',
        html: `<div style="
            width: 40px;
            height: 40px;
            background-image: url('images/pins/underrated.png');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center bottom;
            filter: drop-shadow(0 3px 6px rgba(0,0,0,0.4));
        "></div>`,
        iconSize: [40, 40],
        iconAnchor: [20, 40],
        popupAnchor: [0, -40]
    });
}
// ========================================
// GEOCODING
// ========================================
async function reverseGeocode(lat, lng) {
    console.log('🌐 Geocoding:', lat, lng);
    
    const corsProxies = [
        '',
        'https://corsproxy.io/?',
        'https://api.codetabs.com/v1/proxy?quest=',
        'https://api.allorigins.win/raw?url='
    ];
    
    const nominatimUrl = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&addressdetails=1&accept-language=en`;
    
    for (let i = 0; i < corsProxies.length; i++) {
        try {
            const proxy = corsProxies[i];
            const url = proxy ? proxy + encodeURIComponent(nominatimUrl) : nominatimUrl;
            
            console.log(`   Attempt ${i + 1}`);
            
            const response = await fetch(url, {
                headers: {
                    'User-Agent': 'UnderratedPH/1.0',
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                console.warn(`   Status: ${response.status}`);
                continue;
            }

            const data = await response.json();

            if (data && data.address) {
                const locationInfo = {
                    region: extractRegion(data.address),
                    province: data.address.province || data.address.state || '',
                    municipality: data.address.city || data.address.town || data.address.municipality || data.address.village || ''
                };

                console.log('✅ Geocoded:', locationInfo);
                return locationInfo;
            }
        } catch (error) {
            console.warn(`   Error:`, error.message);
            continue;
        }
    }
    
    console.error('❌ Geocoding failed');
    showLocationNotification('Geocoding failed', 'error');
    return null;
}

function extractRegion(address) {
    const province = (address.province || address.state || '').trim().toLowerCase();

    const regionMap = {
        'ilocos norte': 'Region-1', 'ilocos sur': 'Region-1', 'la union': 'Region-1', 'pangasinan': 'Region-1',
        'batanes': 'Region-2', 'cagayan': 'Region-2', 'isabela': 'Region-2', 'nueva vizcaya': 'Region-2', 'quirino': 'Region-2',
        'aurora': 'Region-3', 'bataan': 'Region-3', 'bulacan': 'Region-3', 'nueva ecija': 'Region-3', 'pampanga': 'Region-3', 'tarlac': 'Region-3', 'zambales': 'Region-3',
        'batangas': 'Region-4A', 'cavite': 'Region-4A', 'laguna': 'Region-4A', 'quezon': 'Region-4A', 'rizal': 'Region-4A',
        'marinduque': 'Region-4B', 'occidental mindoro': 'Region-4B', 'oriental mindoro': 'Region-4B', 'palawan': 'Region-4B', 'romblon': 'Region-4B',
        'albay': 'Region-5', 'camarines norte': 'Region-5', 'camarines sur': 'Region-5', 'catanduanes': 'Region-5', 'masbate': 'Region-5', 'sorsogon': 'Region-5',
        'aklan': 'Region-6', 'antique': 'Region-6', 'capiz': 'Region-6', 'guimaras': 'Region-6', 'iloilo': 'Region-6', 'negros occidental': 'Region-6',
        'bohol': 'Region-7', 'cebu': 'Region-7', 'negros oriental': 'Region-7', 'siquijor': 'Region-7',
        'biliran': 'Region-8', 'eastern samar': 'Region-8', 'leyte': 'Region-8', 'northern samar': 'Region-8', 'samar': 'Region-8', 'southern leyte': 'Region-8',
        'zamboanga del norte': 'Region-9', 'zamboanga del sur': 'Region-9', 'zamboanga sibugay': 'Region-9',
        'bukidnon': 'Region-10', 'camiguin': 'Region-10', 'lanao del norte': 'Region-10', 'misamis occidental': 'Region-10', 'misamis oriental': 'Region-10',
        'davao de oro': 'Region-11', 'davao del norte': 'Region-11', 'davao del sur': 'Region-11', 'davao occidental': 'Region-11', 'davao oriental': 'Region-11',
        'cotabato': 'Region-12', 'sarangani': 'Region-12', 'south cotabato': 'Region-12', 'sultan kudarat': 'Region-12',
        'agusan del norte': 'Region-13', 'agusan del sur': 'Region-13', 'dinagat islands': 'Region-13', 'surigao del norte': 'Region-13', 'surigao del sur': 'Region-13',
        'basilan': 'BARMM', 'lanao del sur': 'BARMM', 'maguindanao': 'BARMM', 'sulu': 'BARMM', 'tawi-tawi': 'BARMM',
        'abra': 'CAR', 'apayao': 'CAR', 'benguet': 'CAR', 'ifugao': 'CAR', 'kalinga': 'CAR', 'mountain province': 'CAR',
        'metro manila': 'NCR', 'national capital region': 'NCR', 'manila': 'NCR'
    };

    for (const [key, region] of Object.entries(regionMap)) {
        if (province === key || province.includes(key)) {
            return region;
        }
    }

    const city = (address.city || '').toLowerCase();
    const ncrCities = ['manila', 'quezon city', 'makati', 'taguig', 'pasig'];
    if (ncrCities.some(nc => city.includes(nc))) {
        return 'NCR';
    }

    return '';
}

// ========================================
// HELPER FUNCTIONS
// ========================================
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

// ========================================
// AUTO-FILL MAIN FUNCTION
// ========================================
async function autoFillLocationFields(locationData) {
    if (!locationData || !locationData.region) {
        showLocationNotification('Could not determine location', 'warning');
        return;
    }

    console.log('🎯 AUTO-FILL START:', JSON.stringify(locationData, null, 2));
    const prefix = currentFormType === 'add' ? '' : 'edit-';

    try {
        // STEP 1: Set Region
        console.log('📍 Step 1: Setting region...');
        const regionFilled = await setRegion(locationData.region, prefix);
        if (!regionFilled) {
            showLocationNotification('Region not found', 'error');
            return;
        }

        // STEP 2: Load Provinces
        console.log('📍 Step 2: Loading provinces...');
        await sleep(800);
        const provincesLoaded = loadProvinces(currentFormType);
        
        if (!provincesLoaded) {
            showLocationNotification('Region filled. Cannot load provinces.', 'warning');
            return;
        }

        if (!locationData.province) {
            showLocationNotification('Region filled only', 'info');
            return;
        }

        // STEP 3: Set Province
        console.log('📍 Step 3: Setting province...');
        await sleep(800);
        const provinceFilled = await setProvince(locationData.province, prefix);
        
        if (!provinceFilled) {
            showLocationNotification('Region filled. Province not found.', 'warning');
            return;
        }

        // STEP 4: Load Municipalities
        console.log('📍 Step 4: Loading municipalities...');
        await sleep(800);
        const municipalitiesLoaded = loadMunicipalities(currentFormType);
        
        if (!municipalitiesLoaded) {
            showLocationNotification('Region & Province filled', 'info');
            return;
        }

        if (!locationData.municipality) {
            showLocationNotification('Region & Province filled', 'info');
            return;
        }

        // STEP 5: Set Municipality
        console.log('📍 Step 5: Setting municipality...');
        await sleep(800);
        const municipalityFilled = await setMunicipality(locationData.municipality, prefix);
        
        if (municipalityFilled) {
            showLocationNotification('✓ All fields filled!', 'success');
        } else {
            showLocationNotification('Region & Province filled', 'info');
        }
        
    } catch (error) {
        console.error('❌ Auto-fill error:', error);
        showLocationNotification('Error filling location fields', 'error');
    }
}

// ========================================
// INDIVIDUAL FIELD SETTERS
// ========================================
async function setRegion(regionValue, prefix) {
    const regionField = document.getElementById(prefix + 'region');
    if (!regionField) {
        console.error('❌ Region field not found');
        return false;
    }

    const matchingOption = Array.from(regionField.options).find(opt => 
        opt.value === regionValue
    );

    if (!matchingOption) {
        console.error(`❌ Region not found in dropdown: "${regionValue}"`);
        console.log('   Available regions:', Array.from(regionField.options).map(o => o.value).filter(v => v));
        return false;
    }

    console.log('✅ Setting region:', matchingOption.value);
    regionField.value = matchingOption.value;
    regionField.dispatchEvent(new Event('change', { bubbles: true }));
    return true;
}

async function setProvince(provinceValue, prefix) {
    const provinceField = document.getElementById(prefix + 'province');
    if (!provinceField) {
        console.error('❌ Province field not found');
        return false;
    }

    // Wait for options to be populated (with retry)
    for (let i = 0; i < 20; i++) {
        const options = Array.from(provinceField.options).filter(opt => opt.value);
        
        if (options.length > 0) {
            console.log(`🔍 Looking for province: "${provinceValue}"`);
            console.log(`   Found ${options.length} province options`);
            
            const match = options.find(opt => {
                const val = opt.value.toLowerCase().trim();
                const search = provinceValue.toLowerCase().trim();
                return val === search || val.includes(search) || search.includes(val);
            });

            if (match) {
                console.log('✅ Setting province:', match.value);
                provinceField.value = match.value;
                provinceField.dispatchEvent(new Event('change', { bubbles: true }));
                return true;
            } else {
                console.warn(`⚠️ Province not found: "${provinceValue}"`);
                console.log('   Available:', options.map(o => o.value).join(', '));
                return false;
            }
        }
        
        console.log(`   ⏳ Retry ${i + 1}/20: Waiting for provinces...`);
        await sleep(200);
    }

    console.error('❌ Province dropdown never populated');
    return false;
}

async function setMunicipality(municipalityValue, prefix) {
    const municipalityField = document.getElementById(prefix + 'municipality');
    if (!municipalityField) {
        console.error('❌ Municipality field not found');
        return false;
    }

    // Wait for options to be populated (with retry)
    for (let i = 0; i < 20; i++) {
        const options = Array.from(municipalityField.options).filter(opt => opt.value);
        
        if (options.length > 0) {
            console.log(`🔍 Looking for municipality: "${municipalityValue}"`);
            console.log(`   Found ${options.length} municipality options`);
            
            const match = options.find(opt => {
                const val = opt.value.toLowerCase().trim().replace(/\s+city$/i, '');
                const search = municipalityValue.toLowerCase().trim().replace(/\s+city$/i, '');
                return val === search || val.includes(search) || search.includes(val);
            });

            if (match) {
                console.log('✅ Setting municipality:', match.value);
                municipalityField.value = match.value;
                municipalityField.dispatchEvent(new Event('change', { bubbles: true }));
                return true;
            } else {
                console.warn(`⚠️ Municipality not found: "${municipalityValue}"`);
                console.log('   Available:', options.map(o => o.value).join(', '));
                return false;
            }
        }
        
        console.log(`   ⏳ Retry ${i + 1}/20: Waiting for municipalities...`);
        await sleep(200);
    }

    console.error('❌ Municipality dropdown never populated');
    return false;
}

// ========================================
// MARKER PLACEMENT
// ========================================
async function placeAdminMarker(latlng) {
    selectedLatLng = latlng;

    if (adminMarker) {
        adminMap.removeLayer(adminMarker);
    }

    adminMarker = L.marker(latlng, {
        icon: createAdminMarkerIcon(),
        draggable: true
    }).addTo(adminMap);

    adminMarker.on('dragend', async function(e) {
        const newLatLng = e.target.getLatLng();
        selectedLatLng = newLatLng;
        updateCoordinatesDisplay(newLatLng);
        showLocationNotification('🔍 Looking up...', 'info');
        const locationData = await reverseGeocode(newLatLng.lat, newLatLng.lng);
        if (locationData) await autoFillLocationFields(locationData);
    });

    updateCoordinatesDisplay(latlng);
    showLocationNotification('🔍 Looking up location...', 'info');
    const locationData = await reverseGeocode(latlng.lat, latlng.lng);
    if (locationData) {
        await autoFillLocationFields(locationData);
    } else {
        showLocationNotification('Could not determine location', 'error');
    }
}

function updateCoordinatesDisplay(latlng) {
    if (currentLat && currentLng) {
        currentLat.textContent = latlng.lat.toFixed(6);
        currentLng.textContent = latlng.lng.toFixed(6);
    }
}

function showLocationNotification(message, type = 'info') {
    const colors = { success: 'bg-green-500', warning: 'bg-yellow-500', info: 'bg-blue-500', error: 'bg-red-500' };
    const icons = { success: 'fa-check-circle', warning: 'fa-exclamation-triangle', info: 'fa-info-circle', error: 'fa-times-circle' };

    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 ${colors[type]} text-white px-6 py-3 rounded-lg shadow-lg z-[9999] transition-opacity duration-300`;
    notification.innerHTML = `<i class="fas ${icons[type]} mr-2"></i>${message}`;
    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.opacity = '0';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

function openPositionModal() {
    modal.classList.remove('hidden');
    
    setTimeout(() => {
        if (!adminMap) {
            initializeAdminMap();
        } else {
            adminMap.invalidateSize();
        }
        
        if (currentFormType === 'edit') {
            const latField = document.getElementById('edit-latitude');
            const lngField = document.getElementById('edit-longitude');
            
            if (latField && lngField && latField.value && lngField.value) {
                const lat = parseFloat(latField.value);
                const lng = parseFloat(lngField.value);
                
                if (!isNaN(lat) && !isNaN(lng)) {
                    placeAdminMarker(L.latLng(lat, lng));
                    adminMap.setView(L.latLng(lat, lng), 12);
                }
            }
        } else {
            selectedLatLng = null;
            if (adminMarker) {
                adminMap.removeLayer(adminMarker);
                adminMarker = null;
            }
            if (currentLat && currentLng) {
                currentLat.textContent = '0';
                currentLng.textContent = '0';
            }
            adminMap.setView([12.8797, 121.7740], 6);
        }
    }, 100);
}

// ========================================
// EVENT LISTENERS
// ========================================
if (addPositionPinBtn) {
    addPositionPinBtn.addEventListener('click', function(e) {
        e.preventDefault();
        currentFormType = 'add';
        openPositionModal();
    });
}

if (editPositionPinBtn) {
    editPositionPinBtn.addEventListener('click', function(e) {
        e.preventDefault();
        currentFormType = 'edit';
        openPositionModal();
    });
}

if (closeBtn) {
    closeBtn.addEventListener('click', function(e) {
        e.preventDefault();
        modal.classList.add('hidden');
    });
}

if (saveBtn) {
    saveBtn.addEventListener('click', function(e) {
        e.preventDefault();
        
        if (selectedLatLng) {
            const latField = currentFormType === 'add' ? 
                document.getElementById('latitude') : 
                document.getElementById('edit-latitude');
            const lngField = currentFormType === 'add' ? 
                document.getElementById('longitude') : 
                document.getElementById('edit-longitude');
                
            if (latField && lngField) {
                latField.value = selectedLatLng.lat.toFixed(6);
                lngField.value = selectedLatLng.lng.toFixed(6);
                
                latField.dispatchEvent(new Event('change', { bubbles: true }));
                lngField.dispatchEvent(new Event('change', { bubbles: true }));
            }
            
            modal.classList.add('hidden');
            showLocationNotification('Coordinates saved!', 'success');
        } else {
            alert('Please click on the map first');
        }
    });
}

if (modal) {
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });
}


// ========================================
// DOM CONTENT LOADED
// ========================================
// ========================================
// AUTO-FILL FROM MANUAL COORDINATE ENTRY
// ========================================
async function handleManualCoordinateEntry(formType) {
    const prefix = formType === 'add' ? '' : 'edit-';
    const latField = document.getElementById(prefix + 'latitude');
    const lngField = document.getElementById(prefix + 'longitude');
    
    if (!latField || !lngField) return;
    
    const lat = parseFloat(latField.value);
    const lng = parseFloat(lngField.value);
    
    // Validate coordinates
    if (isNaN(lat) || isNaN(lng)) {
        console.log('⚠️ Invalid coordinates');
        return;
    }
    
    if (lat < -90 || lat > 90 || lng < -180 || lng > 180) {
        showLocationNotification('Invalid coordinates range', 'error');
        return;
    }
    
    console.log('🎯 Manual coordinate entry detected:', lat, lng);
    showLocationNotification('🔍 Looking up location...', 'info');
    
    // Reverse geocode and auto-fill
    const locationData = await reverseGeocode(lat, lng);
    if (locationData) {
        currentFormType = formType;
        await autoFillLocationFields(locationData);
        
        // If modal is open, update the marker
        if (!modal.classList.contains('hidden') && adminMap) {
            const latlng = L.latLng(lat, lng);
            if (adminMarker) {
                adminMap.removeLayer(adminMarker);
            }
            adminMarker = L.marker(latlng, {
                icon: createAdminMarkerIcon(),
                draggable: true
            }).addTo(adminMap);
            
            adminMarker.on('dragend', async function(e) {
                const newLatLng = e.target.getLatLng();
                selectedLatLng = newLatLng;
                updateCoordinatesDisplay(newLatLng);
                showLocationNotification('🔍 Looking up...', 'info');
                const locationData = await reverseGeocode(newLatLng.lat, newLatLng.lng);
                if (locationData) await autoFillLocationFields(locationData);
            });
            
            adminMap.setView(latlng, 12);
            selectedLatLng = latlng;
            updateCoordinatesDisplay(latlng);
        }
    }
}

// Debounce function to prevent too many API calls
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// ========================================
// DOM CONTENT LOADED
// ========================================
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    document.querySelectorAll('.tab').forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            
            // Reset all tab styles
            document.querySelectorAll('.tab').forEach(t => {
                t.classList.remove('bg-primary-700', 'text-white');
                t.classList.add('bg-white', 'text-gray-700', 'border-gray-300');
            });
            
            // Add active state to clicked tab
            this.classList.add('active');
            this.classList.remove('bg-white', 'text-gray-700', 'border-gray-300');
            this.classList.add('bg-primary-700', 'text-white');
            
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            
            // Show selected tab content
            document.getElementById(this.dataset.tab + '-tab').classList.add('active');
            
            // Clear any messages
            const message = document.getElementById('message');
            message.textContent = '';
            message.className = 'message hidden';
            
            // Load content based on selected tab
            if (this.dataset.tab === 'manage') {
                loadSpots();
            } else if (this.dataset.tab === 'featured') {
                if (document.getElementById('featured-spots-list').children.length === 0) {
                    loadFeaturedSpots();
                }
            } else if (this.dataset.tab === 'users') {
                loadUsers();
            } else if (this.dataset.tab === 'ratings') {
                loadRatings();
            } else if (this.dataset.tab === 'statistics') {
                if (typeof initializeChartsWithData === 'function') {
                    initializeChartsWithData();
                }
            }
        });
    });
    
    // Ensure coordinate fields are fully editable (not readonly)
    document.querySelectorAll('#latitude, #longitude, #edit-latitude, #edit-longitude').forEach(input => {
        if (input) {
            // Remove readonly attribute if it exists
            input.removeAttribute('readonly');
            input.readOnly = false;
            
            // Ensure proper classes for styling
            input.classList.remove('cursor-not-allowed', 'bg-gray-100');
            input.classList.add('bg-white');
        }
    });
    
    // ========================================
    // AUTO-FILL ON MANUAL COORDINATE ENTRY
    // ========================================
    
    // Debounced handler for coordinate changes (1 second delay)
    const debouncedAddCoordHandler = debounce(() => handleManualCoordinateEntry('add'), 1000);
    const debouncedEditCoordHandler = debounce(() => handleManualCoordinateEntry('edit'), 1000);
    
    // Add form coordinate listeners
    const addLatField = document.getElementById('latitude');
    const addLngField = document.getElementById('longitude');
    
    if (addLatField && addLngField) {
        addLatField.addEventListener('input', debouncedAddCoordHandler);
        addLngField.addEventListener('input', debouncedAddCoordHandler);
        
        // Also trigger on blur (when user leaves the field)
        addLatField.addEventListener('blur', () => handleManualCoordinateEntry('add'));
        addLngField.addEventListener('blur', () => handleManualCoordinateEntry('add'));
    }
    
    // Edit form coordinate listeners
    const editLatField = document.getElementById('edit-latitude');
    const editLngField = document.getElementById('edit-longitude');
    
    if (editLatField && editLngField) {
        editLatField.addEventListener('input', debouncedEditCoordHandler);
        editLngField.addEventListener('input', debouncedEditCoordHandler);
        
        // Also trigger on blur
        editLatField.addEventListener('blur', () => handleManualCoordinateEntry('edit'));
        editLngField.addEventListener('blur', () => handleManualCoordinateEntry('edit'));
    }
    
    console.log('✅ Manual coordinate entry automation activated');
});