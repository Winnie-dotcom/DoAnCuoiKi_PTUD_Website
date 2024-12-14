<?php
// Kết nối đến MySQL
$conn = new mysqli("localhost", "root", "", "btj");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Dữ liệu sản phẩm
$san_pham = [
    [1,'Nhẫn Twisted Silver Elegance Ring', 'Nhẫn', '319000', 20, 'Elegance Twist Silver Ring là một trang sức tinh xảo, thiết kế đơn giản để điểm xuyết cho ngón tay của bạn với một chút thanh lịch. Được làm từ bạc cao cấp, chiếc nhẫn này có một họa tiết xoắn tinh tế, phản chiếu ánh sáng đẹp mắt. Chúng linh hoạt, phù hợp cho cả trang phục hàng ngày và trang phục trang trọng, đảm bảo bạn mang theo một phần tinh tế bên mình bất cứ nơi nào bạn đến.', 'Nhẫn Twisted Silver Elegance Ring.jpg'],

    [2, 'Nhẫn Simple Splendor Ring', 'Nhẫn', '269000' , 20, 'Simple Splendor Ring là sự tinh tế trong từng đường nét. Với thiết kế đơn giản nhưng không kém phần sang trọng, chiếc nhẫn này tôn vinh vẻ đẹp của sự giản dị. Bạc chất lượng cao được chế tác một cách tỉ mỉ, mang lại ánh sáng nhẹ nhàng và quý phái cho người đeo. Phù hợp với mọi phong cách, Simple Splendor Ring là lựa chọn hoàn hảo để thể hiện sự tinh giản đầy quyến rũ.','Nhẫn Simple Splendor Ring.jpg'],
    
    [3, 'Vòng tay Ethereal Silver Strand', 'Vòng tay', '449000' , 20, 'Ethereal Silver Strand được thiết kế với từng mắt xích nhỏ tinh tế được chế tác tỉ mỉ, là một tác phẩm nghệ thuật đích thực. Nó không chỉ là một món trang sức, mà còn là một biểu tượng cho vẻ đẹp nhẹ nhàng, tinh tế của người phụ nữ. kết hợp với từng hạt nhỏ càng làm tôn lên vẻ sang trọng. Khi đeo trên cổ tay, mỗi mắt xích lấp lánh như những ngôi sao lẻ loi, tạo nên một hiệu ứng huyền ảo và quyến rũ, gợi lên một vẻ đẹp không cần phô trương. Đây chắc chắn sẽ là một món quà ý nghĩa và một người bạn đồng hành lý tưởng trong hành trình tôn vinh vẻ đẹp của bạn.', 'Vòng tay Ethereal Silver Strand.jpg'],
    
    [4, 'Vòng tay Galaxia Lunaire', 'Vòng tay', '599000' , 19, 'Dưới ánh trăng, chiếc vòng tay bạc lấp lánh như dải ngân hà ôm lấy cổ tay, mỗi viên pha lê hồng là một hành tinh nhỏ, chứa đựng những ước mơ và khát vọng của người phụ nữ. Bạc - chất liệu của mặt trăng, cùng với ánh sáng huyền bí, tượng trưng cho sức mạnh mềm mại nhưng kiên cường, không bao giờ tắt. “Galaxia Lunaire” không chỉ là tên gọi, mà còn là lời nhắc nhở về vẻ đẹp vô tận và sức mạnh tiềm ẩn của người phụ nữ, giống như ánh sáng của mặt trăng soi rọi và dải ngân hà trải dài trong vũ trụ. Như vòng nguyệt quế của các nữ thần, chiếc vòng tay là lời ca tụng cho vẻ đẹp vượt thời gian.', 'Vòng tay Galaxia Lunaire.png'],
    
    [5, 'Vòng cổ Timeless Luminescence Necklace', 'Vòng cổ', '569000' , 20, 'Timeless Luminescence Necklace là biểu tượng của vẻ đẹp trường tồn và ánh sáng vĩnh cửu. Được chế tác tỉ mỉ từ bạc 925 cao cấp, kết hợp cùng viên kim cương tự nhiên lấp lánh, chiếc vòng cổ này mang đến sự sang trọng, tinh tế và thu hút mọi ánh nhìn.
    Mặt dây chuyền chính là điểm nhấn độc đáo của sản phẩm, với viên kim cương nhỏ nhưng rực rỡ, phản chiếu ánh sáng mọi góc độ. Viên kim cương không chỉ là món trang sức quý giá mà còn tượng trưng cho sự vĩnh cửu, vẻ đẹp không tì vết và sức mạnh nội tâm của người đeo.
    Dưới ánh sáng, Timeless Luminescence Necklace tỏa sáng rực rỡ như những tia nắng mặt trời, tô điểm cho vẻ đẹp của người phụ nữ thêm phần sang trọng và cuốn hút. Chiếc vòng cổ này không chỉ là một món phụ kiện thông thường mà còn là lời khẳng định về giá trị bản thân và niềm tin vào những điều tốt đẹp trong cuộc sống.', 'Vòng cổ Timeless Luminescence Necklace.png'],
    
    [6, 'Vòng cổ Floral Fluttering Butterfly Necklace', 'Vòng cổ', '549000' , 20, 'Floral Fluttering Butterfly Necklace là hiện thân của vẻ đẹp thanh tao và tinh tế, nơi những bông hoa rực rỡ hòa quyện cùng hình ảnh bướm bay lượn nhẹ nhàng, mang đến cho bạn cảm giác như lạc bước vào một khu vườn cổ tích đầy mê hoặc.
    Được chế tác tỉ mỉ từ bạc 925, chiếc vòng cổ này nổi bật với mặt dây chuyền hình bướm được thiết kế sống động và mềm mại, như thể đang đùa vui trong vườn hoa rực rỡ. Từng đường nét tinh tế trên cánh bướm đều được khắc họa một cách hoàn hảo, thể hiện sự trau chuốt và tâm huyết của người nghệ nhân.
    Hơn cả một món trang sức, Floral Fluttering Butterfly Necklace còn là biểu tượng cho sự lột xác, tự do, may mắn và hạnh phúc. Hình ảnh bướm bay lượn trong vườn hoa tượng trưng cho hành trình trưởng thành và phát triển, vượt qua mọi khó khăn để đạt được thành công.', 'Vòng cổ Floral Fluttering Butterfly Necklace.jpg'],
    
    [7, 'Hoa tai Starlight Empowerment', 'Hoa tai', '349000' , 20, 'Hoa tai Bạc Starlight Empowerment không chỉ là một món phụ kiện đơn thuần, mà còn là lời tuyên ngôn về niềm tin, hy vọng và khát vọng của người phụ nữ hiện đại. Lấy cảm hứng từ những vì sao lấp lánh trên bầu trời đêm, mỗi chiếc hoa tai được chế tác tinh xảo, mang trong mình thông điệp về vẻ đẹp nội tâm và sức mạnh tiềm ẩn của người phụ nữ. Khi sở hữu Starlight Empowerment, bạn sẽ cảm nhận được nguồn năng lượng tích cực và sự tự tin lan tỏa. Nó sẽ là nguồn động lực giúp bạn vượt qua mọi khó khăn, thử thách và gặt hái thành công trong cuộc sống.', 'Hoa tai Starlight Empowerment.jpg'],
    
    [8, 'Hoa tai Zephyr & Gale', 'Hoa tai', '369000' , 20, 'Hoa tai Bạc "Zephyr & Gale" là thiết kế độc đáo lấy cảm hứng từ hình ảnh hai chiếc chong chóng, một lớn và một nhỏ, được chế tác tinh xảo từ bạc cao cấp. Chiếc chong chóng lớn tượng trưng cho người phụ nữ trưởng thành, mạnh mẽ và bản lĩnh, trong khi chiếc chong chóng nhỏ tượng trưng cho những cô gái trẻ trung, năng động và đầy mơ ước. Hai chiếc chong chóng được kết nối với nhau một cách hài hòa, thể hiện sự đồng hành, gắn bó và che chở cho nhau giữa những thế hệ phụ nữ.', 'Hoa tai Zephyr & Gale.jpg'],
    
    [9, 'Nhẫn Infinity Knot Ring', 'Nhẫn', '269000' , 20, 'Infinity Knot Ring là biểu tượng cho sự kết nối vĩnh cửu và tình yêu bất diệt, được chế tác tinh xảo từ bạc 925 cao cấp sáng bóng. Thiết kế độc đáo với nút thắt nhỏ, tượng trưng cho sự gắn kết bền chặt và mối quan hệ trường tồn. Infinity Knot Ring không chỉ là món phụ kiện trang sức tôn lên phong cách thanh lịch, hiện đại mà còn mang ý nghĩa sâu sắc, là món quà hoàn hảo dành cho bản thân, bạn bè, người yêu hoặc bạn đời trong những dịp đặc biệt như sinh nhật, ngày lễ tình nhân, hay kỷ niệm ngày cưới.', 'Nhẫn Infinity Knot Ring.jpg'],
   
    [10, 'Set nhẫn Infinity & Beyond Set', 'Nhẫn', '299000' , 20, 'Infinity & Beyond Set là bộ trang sức độc đáo bao gồm 3 chiếc nhẫn được chế tác tinh xảo từ bạc sterling cao cấp sáng bóng. Bộ sản phẩm mang ý nghĩa sâu sắc, tượng trưng cho sự kết nối vĩnh cửu, tình yêu bất diệt và hành trình chinh phục những điều không tưởng.', 'Set nhẫn Infinity & Beyond Set.jpg'],
    
    [11, 'Nhẫn Bunny Ring', 'Nhẫn', '349000' , 20, 'Bunny Ring là hiện thân của vẻ đẹp thanh lịch và hiện đại, được chế tác từ bạc 925 cao cấp sáng bóng, mang đến sự sang trọng và tinh tế cho người sở hữu. Thiết kế xoắn ốc độc đáo tạo điểm nhấn ấn tượng, thu hút mọi ánh nhìn, đồng thời tượng trưng cho sức mạnh nội tâm và hành trình chinh phục ước mơ. Bunny Ring hứa hẹn sẽ là điểm nhấn hoàn hảo cho mọi phong cách thời trang, góp phần tô điểm thêm nét cá tính và tự tin cho bạn.', 'Nhẫn Bunny Ring.png'],
    
    [12, 'Vòng tay Luminous Rhapsody', 'Vòng tay', '569000' , 20, 'Luminous Rhapsody là một sự kết hợp hoàn hảo giữa nghệ thuật và phong cách, vòng tay ôm sát cổ tay một cách nhẹ nhàng, tạo điểm nhấn lấp lánh đầy thu hút. Dây chuyền mảnh được thiết kế như những sợi dây guitar, và hạt trang sức lấp lánh như những nốt nhạc đầy nhiệt huyết. Viên đá quý nhỏ nơi hai dây chuyền gặp nhau không chỉ là một điểm nhấn, nó là một biểu tượng của sự phá cách, như một hình xăm nhỏ, một dấu ấn cá nhân không thể nhầm lẫn. Với nét cá tính lại nhẹ nhàng, Luminous Rhapsody dễ dàng phối hợp với nhiều trang phục, từ thanh lịch, sang trọng đến cá tính, độc đáo. Mang đến phong cách thời trang độc đáo, tự tin khẳng định bản thân.', 'Vòng tay Luminous Rhapsody.png'],
   
    [13, 'Vòng cổ Aurora s Tears Necklace', 'Vòng cổ', '549000' , 20, 'Vòng cổ Auroras Tears Necklace là hiện thân của vẻ đẹp thanh tao và tinh tế, nơi những bông hoa rực rỡ hòa quyện cùng hình ảnh bướm bay lượn nhẹ nhàng, mang đến cho bạn cảm giác như lạc bước vào một khu vườn cổ tích đầy mê hoặc.

        Được chế tác tỉ mỉ từ bạc 925, chiếc vòng cổ này nổi bật với mặt dây chuyền hình bướm được thiết kế sống động và mềm mại, như thể đang đùa vui trong vườn hoa rực rỡ. Từng đường nét tinh tế trên cánh bướm đều được khắc họa một cách hoàn hảo, thể hiện sự trau chuốt và tâm huyết của người nghệ nhân.

        Hơn cả một món trang sức, Floral Fluttering Butterfly Necklace còn là biểu tượng cho sự lột xác, tự do, may mắn và hạnh phúc. Hình ảnh bướm bay lượn trong vườn hoa tượng trưng cho hành trình trưởng thành và phát triển, vượt qua mọi khó khăn để đạt được thành công.','Vòng cổ Auroras Tears Necklace.jpg'],
    
    [14, 'Hoa tai Celestial Aspiration', 'Hoa tai', '349000' , 20, 'Hoa tai bạc "Celestial Aspiration" không chỉ là một món phụ kiện trang sức thông thường, mà còn là biểu tượng cho vẻ đẹp thanh lịch, mạnh mẽ và đầy tham vọng của người phụ nữ. Lấy cảm hứng từ hình ảnh người phụ nữ kiêu sa, bí ẩn như bầu trời đêm đầy sao, "Celestial Aspiration" là món quà hoàn hảo dành cho những ai muốn khẳng định bản thân và theo đuổi ước mơ của mình. Thiết kế độc đáo với 4 ngôi sao lấp lánh, tượng trưng cho chòm sao Bắc Đẩu - chòm sao dẫn đường cho những người lữ hành.', 'Hoa tai Celestial Aspiration.jpg'],

];

// Chuẩn bị câu lệnh SQL để chèn dữ liệu vào cơ sở dữ liệu
$stmt = $conn->prepare("INSERT INTO san_pham (id, ten_san_pham, phan_loai, gia_ban, so_luong_trong_kho, mo_ta_san_pham, anh_minh_hoa) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)");

// Kiểm tra nếu câu lệnh chuẩn bị thành công
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// Duyệt qua từng sản phẩm và thực thi câu lệnh
foreach ($san_pham as $sp) {
    // Kiểm tra xem phan_loai có rỗng không, nếu có thì cho giá trị mặc định là 'Chưa xác định'
    $phan_loai = $sp[2] ? $sp[2] : 'Chưa xác định';
    
    // Sửa lại số lượng tham số cho phù hợp với câu lệnh SQL
    $stmt->bind_param("issdsss", $sp[0], $sp[1], $phan_loai, $sp[3], $sp[4], $sp[5], $sp[6]);
    $stmt->execute();
}

// Kiểm tra việc chèn dữ liệu
if ($stmt->affected_rows > 0) {
    echo "Dữ liệu đã được thêm thành công!";
} else {
    echo "Không có dữ liệu nào được thêm.";
}

// Đóng kết nối
$stmt->close();
$conn->close();
?>
