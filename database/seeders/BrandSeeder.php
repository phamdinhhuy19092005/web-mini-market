<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run()
    {
        $brands = [
            // Các thương hiệu trước đó
            "MERINO", "CELANO", "NESTLE", "BINGGRAE", "WALL'S", "LOTTE", "HAAGEN DAZS", "AICE", "JOYDAY", "VINAMILK",
            "TH TRUE MILK", "YAKULT", "ĐÀ LẠT MILK", "FARMERS UNION", "BETAGEN", "LOTHAMILK", "MEIJI", "SG MILK",
            "MORINAGA", "NUTI", "YOMOST", "DELIFRES", "LOF MALTO", "NUVI", "KUN", "BAMBOO", "THỌ PHÁT", "BIBIGO",
            "O'SMILES", "PULMUONE", "KINGXBON", "HETORI", "SUNDO", "TÂN VĨNH PHÁT", "MANNA", "HUE SPECIALTY", "OPLANT",
            "SPRING HOME", "HOA DOANH", "KITKOOL", "SA GIANG", "BON", "OCEAN GIFT", "NHẬT VÂN", "DENTI", "ĐẠI NAM",
            "HẢI NAM", "MVP", "WIKI FRESH", "CP", "CK", "CJ CẦU TRE", "CÁ SẠCH", "G", "CHEN LIN", "NIPPON CHV",
            "VISSAN", "LE GOURMET", "MEAT MASTER", "ĐỨC VIỆT", "PONNIE", "VS", "HƯƠNG BIỂN", "MEATDELI", "G4YOU",
            "HAHA", "IKA", "NGỌC THƠM", "TRẦN PHÁT HOÀI", "NẤM TƯƠI CƯỜI", "MEATDELI - KHÔNG CKCB", "NẮNG MAI",
            "THẠCH AN", "FLAN ÁNH HỒNG", "SWEETHOME", "THƠM", "THÁI SƠN", "COSIA", "SUNITY", "TÂM LỢI", "VỊ NGUYÊN",
            "ICHIBAN", "EB", "SAMHO", "AKIRA", "KANI", "CB", "TRẦN GIA", "LUTOSA", "FARM BEST", "ANDROS", "EMBORG",
            "JONGGA", "KING", "ÔNG KIM'S", "BA KHÁNH", "NUFFAM", "THIÊN LƯƠNG", "BẢO MINH", "TÂN HUÊ VIÊN",
            "VIETSPECIAL", "SAVOURE", "ROYAL FAMILY", "TOPCOCO", "RỒNG VÀNG HOÀNG GIA", "MAISON", "NUTTY",
            "CÁT KHÁNH", "OH SMILE NUTS", "YOUR SUPER FOOD", "CHACHEER", "HAOXIANGNI", "DAN D PAK",
            "BÀ TƯ BÌNH PHƯỚC", "NHABEXIMS", "VINAMIT", "CAM NGUYÊN", "CHEER TALK", "O'FOOD", "LAY'S", "OISHI",
            "TÂN TÂN", "HBK", "DORITOS", "TAOKAENOI", "ENAAK", "HEYYO", "GENKAI", "KINH ĐÔ", "KARAMUCHO", "POCA",
            "VỊ", "SLIDE", "WEILONG", "RUAY PUAN", "HẢI CHÂU", "GOKOCHI", "LAY'S MAX", "DOSI", "O'STAR", "PRINGLES",
            "AN NHIÊN", "LAY'S STAX", "BENTO", "MINH CHÂU", "FRESH CUTS", "TALEATHONG", "TAYO", "FNV", "SUPER RING",
            "POSI", "TAM FOOD", "ORION", "RICHEESE", "POCKY", "OREO", "RICHY", "PORORO", "WANT WANT", "QUAKER",
            "DORKBUA", "COSY", "TIPO", "ICHI", "AN", "BAULI", "C'EST BON", "RITZ", "AFC", "SHOOTING STAR",
            "GOLD DAISY", "SHIENG TIAN", "GERY", "MIX", "DANISA", "CHOCO PN", "ONE ONE", "SOLITE", "LEIBNIZ",
            "NABATI", "SUPER STAR", "LU", "MAGIC", "GO CHOCO", "CAL CHEESE", "KIDO", "DELIPIE", "RUBY & BEN",
            "NGON NGON", "MONESCO", "DEKA", "OVALTINE", "SHANG TIAN", "PLAYMORE", "CHUPA CHUPS", "HARIBO",
            "ALPENLIEBE", "ZED", "EIKODO", "DR BEAR", "DOUBLEMINT", "MENTOS", "HI-CHEW", "TIC TAC", "KRACIE",
            "SKITTLES", "LOTTE XYLITOL", "YUPI", "KINDER JOY", "JACK 'N JILL", "STRIKING", "THANH BÌNH", "RICOLA",
            "AMOS", "POPIT", "COOL AIR", "LOTTE ANYTIME", "FUNMORE", "SUGUS", "WOM", "PATI", "MINIONS", "FOX'S",
            "FRES", "BEBETO", "TAMARIN", "WERTHER'S", "TRIDENT", "DR.Q", "CALBEE", "KELLOGG'S", "XUÂN AN",
            "QUÊ TÔI", "LOTUS HEALTHY FOOD", "SWEET MONSTER", "KITKAT", "SNICKERS", "M&M", "CADBURY",
            "SCHOGETTEN", "FERRERO ROCHER", "TOBLERONE", "HERSHEY KISSES", "CHOCO ROCK", "ANDES", "NUTELLA",
            "DUY ANH BEE", "LE FRUIT", "BONNE MAMAN JAMS", "MIELE", "ÁNH HỒNG", "JIN JIN", "NEW CHOICE",
            "MINH NHẬT", "SIMPLY", "VIETCOCO", "OLIVOILA", "MEIZAN", "TƯỜNG AN", "BASSO", "NEPTUNE", "KIDDY",
            "COBA", "JANBEE", "NƯỚC MẮM TĨN", "LÀNG CHÀI XƯA", "NAM NGƯ", "HƯNG THỊNH", "HẠNH PHÚC", "HỒNG HẠNH",
            "THANH HÀ", "CHIN-SU", "VỊ XƯA", "CHOLIMEX", "3 CON TÔM", "ĐẠI NHẤT", "NHẤT TÂM", "BARONA",
            "ÔNG CHÀ VÀ", "VIPEP", "OTTOGI", "BARILLA", "VIỆT SAN", "DH FOODS", "YAMAMORI", "SG FOOD", "BELL FOODS",
            "HEINZ", "AJI-QUICK", "LEE KUM KEE", "KNORR", "EBARA", "BIÊN HÒA", "NAM DƯƠNG", "AJI-MAYO", "KEWPIE",
            "SÔNG HƯƠNG", "TABASCO", "AJINOMOTO", "AJI-NGON", "MAGGI", "VIFON", "VEDAN", "KIKKOMAN",
            "TAM THÁI TỬ", "THÀNH PHÁT", "ACECOOK", "S&B", "BÔNG MAI", "CÔ RI", "AJI-XỐT", "GUNGON", "EUFOOD",
            "MOM COOKS", "MINH HÀ", "VUA GẠO", "MÊ GẠO", "VINH HIỂN", "KIM THIÊN LỘC", "MẦM ĐẤT", "HOME RICE",
            "PMT", "ÔNG CỤ", "NA SIAM", "KITOKU", "TUẤN LINH", "MIKKO", "ROVIN", "BAKERS' CHOICE", "BINARI",
            "MIWON", "GODBAWEE", "OKENKI", "GIMJABAN", "CAPTAIN LEE", "OTOKI", "NONGSHIM", "ISOUP", "WAI WAI",
            "YẾN VIỆT", "SEAWEED", "3 MIỀN", "MILIKET", "ROZA", "HẠ LONG CANFOCO", "3 CÔ GÁI", "TULIP", "SEACROWN",
            "SEASPIMEX", "SPAM", "FRAGATA", "JEAN FLOC'H", "AYAM BRAND", "LILLY", "LA PEDRIZA", "WYN", "SARDINES",
            "HEO CAO BỒI", "HCT", "OMACHI", "SIUKAY", "SAMYANG", "KORENO", "MAMA", "NISSIN", "CUNG ĐÌNH", "GẤU ĐỎ",
            "INDOMIE", "SGFOOD", "KOOL", "BON GO JANG", "SEDAAP", "KOKOMI", "SEMPIO", "LE BROTHER", "SAN REMO",
            "PASTA ZARA", "AN LỢI", "SONG LONG", "MINH DƯƠNG", "JIMMY FOOD", "CÀ MÈN", "CÂY THỊ", "ASUZAC",
            "SHANG-HA", "YOPOKKI", "PHƯƠNG NGUYÊN", "OTTO", "YAMAZAKI", "STAFF", "SAVOUREBAKE", "MOMIJI",
            "LV NUFRES", "HARRYS", "UMIKI", "SAMLIP", "FE'STA", "SIYE BAKING", "BMQ", "SCJ", "SANDOCHI", "OHSAWA",
            "KODOCHI", "MISS BÁNH TRÁNG", "COCA COLA", "PEPSI", "7UP", "SCHWEPPES", "MIRINDA", "SPRITE", "FANTA",
            "REVIVE", "AQUAFINA", "TWISTER", "UNIF", "OOLONG TEA+", "MECO", "COZY", "ĐẠI GIA", "STAR KOMBUCHA",
            "LADOPHAR", "BONCHA", "FUZE TEA +", "TEA365", "WIL", "LIPTON", "TEAROMA", "MR. BROWN", "HILLWAY",
            "OI CHA", "KHÔNG ĐỘ", "NESTEA", "POCARI", "STING", "MONSTER", "REDBULL VIETNAM", "REDBULL", "ROCK STAR",
            "AQUARIUS", "WARRIOR", "C-VITT", "CARABAO", "NUMBER 1", "SATORI", "ION LIFE", "DASANI", "VĨNH HẢO",
            "SAPUWA", "OCANY", "HIKARI", "FUJIWA", "EVIAN", "La Vie", "HEINEKEN", "TIGER", "SAIGON", "CORONA",
            "BUDWEISER", "1664", "CHANG", "BUDVAR", "RED HORSE", "SAPPORO", "HOEGAARDEN", "FELDSCHLOBCHEN",
            "SAN MIGUEL", "PAULANER", "333", "CHILL COCKTAIL", "GUBERNIJA", "HUDA", "EDELWEISS", "ASAHI",
            "PILSNER URQUELL", "DINKELACKER", "CARLSBERG", "COCOXIM", "CHABAA", "VICO FRESH", "MALEE", "MOGU MOGU",
            "MINUTE MAID", "FRUIT ME UP", "TRUNG NGUYÊN", "CÀ PHÊ PHỐ", "NESCAFE", "THE COFFEE HOUSE", "HIGHLANDS",
            "VINACAFE", "K-COFFEE", "PHƯƠNG VY", "WAKE UP", "BOSS", "VNCOFFEE", "GEORGIA MAX", "GREEN BIRD",
            "WIN'S NEST", "NUTRI BOOST", "SANEST", "Woongjin", "JINRO", "TALCA", "GOOD DAY", "VODKA HANOI",
            "IMOGINO", "TAVERNELLO", "MEN'S VODKA", "JOHNNIE WALKER", "TINI", "CHATEAU CLARKE", "TAE YANG",
            "DON VALENTIN", "SEAGRAM'S", "SOMERSBY", "KOOK SOON DANG", "STRONGBOW",

            // Thương hiệu mới (đã thêm và loại bỏ trùng lặp)
            "DAEWOO", "THIÊN HƯƠNG", "BLESS YOU", "PULPPY", "GUMI", "PREMIER", "ELENE", "LETGREEN", "HANNAH SEYO",
            "MAMAMY", "JUNO", "HUGGIES", "MAXKLEEN", "INOCHI", "TBP", "STAHAUS", "LAFONTE", "TÂN BÁCH PHÁT",
            "MORNING WRAP", "MORIITALIA", "KOKUSAI", "EVEREADY", "ENERGIZER", "SPRIING", "CASAVI", "NNB",
            "SCOTCH-BRITE", "LIFEBUOY", "ROMANO", "X-MEN", "ENCHANTEUR", "LUX", "HAZELINE", "DOVE", "CLEAR",
            "SAFEGUARD", "AXE", "GILLETTE", "JOMI", "POP-PUF", "COLGATE", "P/S", "SENSODYNE", "CLOSEUP",
            "LISTERINE", "FAMAPRO", "ORAL B", "DR. MUỐI", "JORDAN", "PANTENE", "SUNSILK", "H&S", "REJOICE",
            "SELSUN", "ON1", "SAKURA", "DIANA", "KOTEX", "LAURIER", "SOFY", "DUREX", "WHISPER", "DẠ HƯƠNG",
            "BLUE", "OMO", "SWAT", "ARIEL", "DOWNY", "COMFORT", "LIX", "POWER100", "SURF", "ABA", "SMILE CHOICE",
            "SUNLIGHT", "EARTH CHOICE", "BOTANIKA", "GIFT", "GLADE", "SUNFLOWER", "AMBIPUR", "AMI", "VIM", "DUCK",
            "MITSUEI", "RAID", "ARS", "JUMBO VAPE", "ARM & HAMMER", "KID'S NEST PLUS+", "THIÊN VIỆT"
        ];

        $brands = array_unique(array_map('strtoupper', $brands));

        foreach ($brands as $brand) {
            DB::table('brands')->insert([
                'name' => $brand,
                'image' => null, 
                'slug' => Str::slug($brand, '-'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}