<?php
// Kết nối đến MySQL
$conn = new mysqli("localhost", "root", "", "btj");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Dữ liệu bài viết
$blog_posts = [
['Tại Sao Trang Sức Bạc Là Lựa Chọn Hoàn Hảo Cho Mọi Dịp?', 'Trang sức bạc không chỉ là một món đồ trang trí mà còn là một biểu tượng của sự tinh tế, phong cách và cá tính. Với sự đa dạng về kiểu dáng, giá cả phải chăng và tính năng tuyệt vời, trang sức bạc đã trở thành lựa chọn yêu thích của nhiều người trên toàn thế giới. Hãy cùng khám phá lý do tại sao trang sức bạc lại được ưa chuộng đến vậy!

1. Sự Đa Dạng Trong Thiết Kế
Trang sức bạc mang đến một thế giới thiết kế vô cùng phong phú, từ những mẫu đơn giản, tinh tế cho đến những kiểu dáng cầu kỳ, độc đáo. Bạn có thể dễ dàng tìm thấy:

Nhẫn bạc với phong cách tối giản hoặc đính đá quý rực rỡ.
Dây chuyền bạc mang biểu tượng cá nhân hóa như chữ cái hoặc hình dáng trái tim.
Bông tai bạc thanh lịch phù hợp cho cả công sở và tiệc tối.
Bạc là chất liệu dễ chế tác, giúp các nghệ nhân tự do sáng tạo ra nhiều kiểu dáng mới lạ, đáp ứng mọi phong cách từ cổ điển đến hiện đại.
2. Giá Cả Phải Chăng Nhưng Vẫn Sang Trọng
So với vàng hoặc bạch kim, bạc có giá cả hợp lý hơn nhưng vẫn mang lại vẻ đẹp không kém phần sang trọng. Điều này làm cho trang sức bạc trở thành sự lựa chọn lý tưởng cho những người muốn đầu tư vào phụ kiện mà không cần chi quá nhiều.

3. Lợi Ích Sức Khỏe Và Đặc Tính Kháng Khuẩn
Bạc không chỉ là món trang sức mà còn có tác dụng tốt đối với sức khỏe:

Bạc có đặc tính kháng khuẩn tự nhiên, giúp bảo vệ da khỏi vi khuẩn.
Trang sức bạc có thể hỗ trợ cân bằng năng lượng cơ thể và giảm căng thẳng.
Đeo bạc còn giúp phát hiện vấn đề sức khỏe qua sự thay đổi màu sắc của bạc khi tiếp xúc với hóa chất hoặc môi trường cơ thể.
4. Phù Hợp Với Mọi Dịp Và Đối Tượng
Trang sức bạc có thể phối hợp dễ dàng với mọi loại trang phục và phù hợp với mọi hoàn cảnh:

Hằng ngày: Những mẫu đơn giản cho phong cách nhẹ nhàng.
Dự tiệc: Trang sức bạc đính đá hoặc thiết kế độc đáo để tạo điểm nhấn.
Quà tặng: Lựa chọn tuyệt vời để dành tặng người thân, bạn bè hay người yêu vào những dịp đặc biệt như sinh nhật, kỷ niệm, hoặc lễ hội.
5. Dễ Bảo Quản Và Làm Sạch
Với một vài mẹo nhỏ, bạn có thể giữ trang sức bạc luôn sáng bóng như mới:

Sử dụng khăn mềm để lau chùi.
Bảo quản trong hộp kín hoặc túi chống ẩm để tránh oxy hóa.
Làm sạch bạc định kỳ bằng dung dịch chuyên dụng hoặc hỗn hợp muối, nước và baking soda.
Lời Kết
Trang sức bạc không chỉ là phụ kiện thời trang mà còn là một phần trong câu chuyện phong cách cá nhân của mỗi người. Với vẻ đẹp tinh tế, tính ứng dụng cao và giá trị bền vững, bạc là lựa chọn hoàn hảo cho mọi người, mọi dịp.

Hãy để những món trang sức bạc tôn vinh vẻ đẹp của bạn và là người bạn đồng hành trong cuộc sống hàng ngày!

Bạn có yêu thích trang sức bạc không? Hãy chia sẻ cảm nhận hoặc những kiểu dáng mà bạn yêu thích trong phần bình luận nhé!', 'Nguyễn Ngọc Nhi', '2024-12-01', 'blog_1.jpg'],
['Cách Bảo Quản Trang Sức Bạc Để Giữ Được Sáng Đẹp', 'Trang sức bạc luôn là lựa chọn yêu thích của nhiều người nhờ vẻ đẹp thanh thoát và giá trị thẩm mỹ. Tuy nhiên, bạc có thể bị xỉn màu và mất đi độ sáng bóng nếu không được bảo quản đúng cách. Dưới đây là một số mẹo giúp bạn giữ cho trang sức bạc luôn đẹp như mới.

1. Tránh Tiếp Xúc Với Hóa Chất
Bạc dễ dàng bị oxy hóa khi tiếp xúc với các hóa chất như nước hoa, kem dưỡng da, hay các chất tẩy rửa gia dụng. Vì vậy, bạn nên tháo trang sức bạc khi sử dụng những sản phẩm này để bảo vệ chúng khỏi bị xỉn màu và mất đi vẻ sáng bóng.

2. Lưu Trữ Đúng Cách
Khi không sử dụng, bạn nên cất giữ trang sức bạc trong các túi vải mềm hoặc hộp đựng trang sức có lót vải để tránh trầy xước. Hãy đảm bảo rằng các món trang sức bạc không tiếp xúc trực tiếp với không khí để hạn chế việc oxy hóa.

3. Vệ Sinh Định Kỳ
Bạc có thể bị xỉn màu do bụi bẩn, dầu từ da hoặc môi trường xung quanh. Bạn có thể làm sạch trang sức bạc bằng cách sử dụng một miếng vải mềm và lau nhẹ nhàng. Để làm sáng bạc, bạn có thể sử dụng dung dịch chuyên dụng dành cho bạc hoặc dùng một ít kem đánh răng không chứa chất tẩy mạnh, sau đó rửa lại với nước ấm và lau khô bằng vải mềm.

4. Tháo Trang Sức Khi Tắm, Bơi Hoặc Ngủ
Nước và độ ẩm có thể làm cho bạc bị oxy hóa nhanh chóng. Vì vậy, bạn nên tháo trang sức bạc khi tắm, bơi hoặc khi đi ngủ để tránh tình trạng bạc bị ố vàng hoặc mất đi độ bóng.

5. Chú Ý Đến Nguồn Sáng
Tránh để trang sức bạc tiếp xúc với ánh sáng mặt trời trực tiếp trong thời gian dài, vì tia UV có thể khiến bạc bị xỉn màu. Lưu trữ trang sức bạc ở nơi khô ráo và thoáng mát để bảo vệ chúng lâu dài.

6. Sử Dụng Sản Phẩm Chuyên Dụng
Ngoài việc vệ sinh bằng các phương pháp thủ công, bạn cũng có thể sử dụng các sản phẩm chuyên dụng như khăn lau bạc hoặc dung dịch làm sáng bạc để duy trì độ sáng bóng của trang sức bạc.

7. Tránh Va Đập Mạnh
Bạc là chất liệu mềm và dễ bị trầy xước hoặc biến dạng nếu bị va đập mạnh. Hãy luôn cẩn thận khi đeo hoặc tháo trang sức bạc và tránh để chúng tiếp xúc với những vật sắc nhọn.

Lời Kết
Bằng cách bảo quản đúng cách, trang sức bạc sẽ luôn giữ được vẻ đẹp sáng bóng và bền lâu. Hãy áp dụng những mẹo trên để giúp món trang sức yêu thích của bạn luôn tỏa sáng!', 'Nguyễn Ngọc Mỹ Bình', '2024-12-15', 'blog_2.png'],
['Tái Hiện Vẻ Đẹp Vàng Son Cùng Trang Sức Bạc', 'Trang sức bạc đã tồn tại như một biểu tượng về sự thanh lịch và sang trọng trong nhiều thế kỷ. Từ những đồ trang sức bằng bạc ngắm đơn giản đến những thiết kế tinh xảo, bạc đã ghi dấu trong trái tim của bao người yêu thời trang. Hãy cùng khám phá lý do vì sao trang sức bạc luôn được ưa chuộng và cách chàm sóc nó nhé!
Vì sao trang sức bạc lại được yêu thích?
1. Đẹp một cách tinh tế
Bạc mang đến vẻ đẹp thanh thoát, đơn giản mà vô cùng sang trọng. Dù là những chiếc nhẫn mỏng nhẹ, bông tai kiểu dáng tối giản, hay vòng cô tay chạm khắc tỷ mỹ, trang sức bạc luôn dễ kết hợp với nhiều phong cách khác nhau.
2. Giá trị hợp lý
So với vàng hoặc bạch kim, trang sức bạc có giá thành phải chăng hơn những vẫn đảm bảo được đẹp và bền bỉ. Điều này khiến bạc trở thành lựa chọn phổ biến cho những ai muốn tô điểm phong cách mà không cần chi tiêu quá nhiều.
3. Dễ chăm sóc
Bạc dễ bị oxy hóa, nhưng bạn có thể dễ dàng làm mới trang sức bạc tại nhà bằng các vật liệu đơn giản như kem đánh răng, dầu olive hoặc nước chanh.
Lựa chọn trang sức bạc phù hợp
Khi mua trang sức bạc, điều quan trọng nhất là hiểu rõ phong cách và nhu cầu của bạn
Trang sức dạo phố: Chọn những thiết kế đơn giản, thanh lịch như những chiếc nhẫn hoặc dây chuyền mỏng.
Trang sức cho dự kiện: Chú trọng các mẩu thiết kế độc đáo, đính đá hoặc chạm khắc phức tạp.Trang sức có ý nghĩa: Nhiều người yêu thích những thiết kế bằng bạc kèm theo biểu tượng độc đáo như mặt nguyệt, hoa, hoặc đá phong thủy.
Chăm sóc trang sức bạc đúng cách.Tránh để trang sức bạc tiếp xúc hóa chất: Những chất như nước hoa, kem dưỡng da có thể làm oxy hóa nhanh bạc.
Làm sạch định kỳ: Sử dụng khăn mềm để lau chà trang sức sau khi sử dụng.Lưu trữ đúng cách: Cất trang sức bạc trong hộp đãng kín hoặc bọc bằng vải để tránh oxy hóa.Trang sức bạc không chỉ là một món đồ trang trí, nó còn thể hiện phong cách và cá tính của bạn. Hãy chọn cho mình những mẩu trang sức phù hợp và trân trọng những giá trị tinh tế mà bạc mang lại!', 'TTuyn', '2024-12-10', 'blog_3.jpg'], 
['Trang Sức Bạc - Vẻ Đẹp Thanh Lịch và Bền Bỉ Theo Thời Gian', 'Trang sức bạc luôn giữ vị trí đặc biệt trong lòng các tín đồ thời trang bởi sự kết hợp hoàn hảo giữa vẻ đẹp thanh lịch, tính đa dụng, và giá trị bền vững. Hãy cùng khám phá lý do vì sao trang sức bạc trở thành lựa chọn yêu thích của mọi người từ những cô nàng hiện đại cho đến những người yêu thích phong cách cổ điển.
1. Vì Sao Nên Chọn Trang Sức Bạc?
Trang sức bạc không chỉ là món phụ kiện thời trang mà còn mang nhiều giá trị đặc biệt:
Phù Hợp Mọi Phong Cách: Với màu sắc ánh kim thanh nhã, bạc dễ dàng kết hợp với mọi trang phục, từ công sở, dạo phố đến các sự kiện quan trọng. Một chiếc vòng cổ bạc tinh tế hay đôi khuyên tai đơn giản cũng đủ làm nổi bật phong cách cá nhân. 
Giá Cả Phải Chăng
So với các kim loại quý khác như vàng hay bạch kim, bạc có mức giá hợp lý, giúp bạn dễ dàng sở hữu nhiều mẫu trang sức đẹp mà không lo ngân sách.. Lợi Ích Sức Khỏe: Bạc có khả năng kháng khuẩn, điều hòa năng lượng và hỗ trợ sức khỏe. Nhiều người tin rằng trang sức bạc giúp bảo vệ cơ thể khỏi những tác động xấu từ môi trường.
2. Các Loại Trang Sức Bạc Phổ Biến: Bạc Ta (Bạc 99) - Loại bạc nguyên chất với độ sáng trắng tự nhiên, thường được sử dụng để chế tác các mẫu trang sức truyền thống hoặc đòi hỏi độ chi tiết cao. Bạc Ý (Sterling Silver) - nĐược pha thêm một chút hợp kim, bạc Ý không chỉ bền mà còn có độ sáng bóng vượt trội, rất được ưa chuộng trong trang sức hiện đại. Bạc Xi Vàng Trắng: Dòng bạc này được phủ một lớp vàng trắng bên ngoài, mang lại vẻ đẹp tinh tế như bạch kim nhưng giá cả dễ chịu hơn.
3. Gợi Ý Trang Sức Bạc Dành Cho Mọi Dịp
Quà tặng bạn gái/người thân: Dây chuyền bạc với mặt hình trái tim hoặc hoa cỏ là lựa chọn hoàn hảo để bày tỏ tình cảm.
Trang sức hàng ngày: Vòng tay hoặc nhẫn bạc đơn giản giúp tăng thêm vẻ sang trọng mà không quá cầu kỳ. Trang sức cho sự kiện: Các mẫu bông tai dáng dài, nhẫn đính đá kết hợp cùng bạc Ý sẽ giúp bạn tỏa sáng trong mọi bữa tiệc.
4. Cách Bảo Quản Trang Sức Bạc Luôn Như Mới. 
- Lau sạch định kỳ: Sử dụng khăn mềm hoặc dung dịch chuyên dụng để giữ trang sức luôn sáng bóng. 

- Bảo quản cẩn thận: Tránh tiếp xúc với hóa chất, mồ hôi hoặc để ở nơi ẩm ướt. Khi không sử dụng, hãy cất trong hộp riêng.

- Phục hồi độ sáng: Nếu bạc bị xỉn màu, bạn có thể làm sạch bằng baking soda hoặc mang đến các tiệm kim hoàn để làm mới.

- Kết Luận: Trang sức bạc không chỉ đẹp mà còn mang trong mình sự tinh tế, bền bỉ và ý nghĩa sâu sắc. Dù là món quà ý nghĩa hay phụ kiện tôn lên phong cách cá nhân, trang sức bạc luôn là lựa chọn đáng giá.Nếu bạn đang tìm kiếm những mẫu trang sức bạc đẹp và chất lượng, hãy tham khảo ngay tại [BTJ] để khám phá những thiết kế thời thượng nhất!', 'Hthu', '2024-12-11', 'blog_4.jpg'],
['Sự Khác Biệt Giữa Bạc Ta Và Bạc Ý', 'Trang sức bạc luôn là sự lựa chọn phổ biến nhờ vào vẻ đẹp tinh tế và giá trị bền vững. Tuy nhiên, bạn đã bao giờ thắc mắc sự khác biệt giữa bạc ta và bạc Ý chưa? Hãy cùng tìm hiểu để chọn được sản phẩm phù hợp với phong cách của bạn. 

- Đặc Điểm Của Bạc Ta-Bạc ta, còn gọi là bạc 99%, là loại bạc gần như nguyên chất. 

   * Đặc điểm nổi bật của bạc ta là:
    - Độ sáng trắng tự nhiên, phù hợp với các thiết kế truyền thống hoặc cần độ chi tiết cao.
    - Mềm hơn so với các loại bạc khác, dễ bị trầy xước nếu không bảo quản cẩn thận.
    
- Đặc Điểm Của Bạc Ý. Bạc Ý (Sterling Silver) chứa 92,5% bạc nguyên chất, pha thêm hợp kim để tăng độ cứng. 

   * Điểm đặc biệt của bạc Ý là:
     - Bền bỉ hơn bạc ta, thích hợp cho các thiết kế hiện đại.
     - Sáng bóng vượt trội và giữ được độ bền lâu dài.3
     
- Nên Chọn Loại Bạc Nào? 

Tùy thuộc vào sở thích và nhu cầu của bạn:

- Nếu bạn yêu thích sự truyền thống, bạc ta là lựa chọn tuyệt vời.
- Nếu bạn muốn một món trang sức hiện đại, bền bỉ, bạc Ý sẽ là lựa chọn lý tưởng

*** Lời Kết: 

Hiểu rõ sự khác biệt giữa bạc ta và bạc Ý sẽ giúp bạn đưa ra quyết định chính xác hơn khi mua trang sức. Dù là loại bạc nào, chúng đều mang lại vẻ đẹp và phong cách riêng biệt.', 'Nguyễn Thu Hà', '2024-12-12', 'blog_5.png'],
['Top 5 Mẫu Trang Sức Bạc Được Yêu Thích Nhất 2024', 'Bạn đang tìm kiếm mẫu trang sức bạc thời thượng để làm mới phong cách của mình? Dưới đây là top 5 mẫu trang sức bạc đang "gây sốt" năm 2024:

1. Dây Chuyền Mặt Trăng: Thiết kế tinh tế với mặt dây chuyền hình trăng lưỡi liềm, phù hợp với phong cách nhẹ nhàng, nữ tính. 

2. Nhẫn Bạc Đính Đá Moissanit Sự kết hợp giữa bạc sáng bóng và đá Moissanite tạo nên vẻ đẹp sang trọng, thích hợp cho những buổi tiệc trang trọng. 

3. Lắc Tay Bạc Đơn Giản Lắc tay bạc kiểu dáng tối giản, dễ dàng phối hợp với mọi trang phục hàng ngày.

4. Bông Tai Dáng Dài. Thiết kế bông tai dáng dài, chạm khắc tinh xảo, là điểm nhấn hoàn hảo cho các sự kiện quan trọng. 

5. Charm Bạc Cá Nhân Hóa. Charm bạc có thể gắn chữ cái hoặc biểu tượng yêu thích, phù hợp để làm quà tặng.

** Hãy ghé thăm cửa hàng BTJ để khám phá những mẫu trang sức bạc này và làm mới phong cách của bạn ngay hôm nay!', 'Trần Quỳnh Anh', '2024-12-14', 'blog_6.png'],
['Bí Quyết Chọn Trang Sức Bạc Theo Phong Thủy', 
'Trang sức bạc không chỉ là phụ kiện thời trang mà còn mang ý nghĩa phong thủy sâu sắc. Nếu bạn muốn chọn được món trang sức bạc phù hợp với mình, hãy tham khảo các bí quyết dưới đây:

1. Chọn Màu Đá Phù Hợp. Bạc thường được kết hợp với các loại đá quý như thạch anh, ngọc trai, hoặc đá phong thủy. Hãy chọn màu đá dựa trên mệnh của bạn:

- Mệnh Kim: Chọn đá trắng hoặc vàng.

- Mệnh Mộc: Chọn đá xanh lá cây.

- Mệnh Thủy: Chọn đá xanh dương hoặc đen.

- Mệnh Hỏa: Chọn đá đỏ hoặc hồng.

- Mệnh Thổ: Chọn đá vàng hoặc nâu đất.

2. Lựa Chọn Theo Hình Dáng Biểu Tượng. hững biểu tượng như mặt trăng, hoa sen, hoặc ngôi sao thường mang lại năng lượng tích cực. 
Hãy chọn những thiết kế mà bạn cảm thấy có ý nghĩa và phù hợp với phong cách cá nhân.

3. Đảm Bảo Chất Lượng Sản Phẩm. Trang sức bạc nên được làm từ bạc ta hoặc bạc Ý để đảm bảo độ bền và giá trị phong thủy. Đừng quên kiểm tra dấu hiệu bạc thật trước khi mua.

**Lời Kết:

Trang sức bạc không chỉ giúp bạn tỏa sáng mà còn mang lại ý nghĩa phong thủy tích cực. Hãy chọn cho mình một món trang sức bạc phù hợp để luôn cảm thấy tự tin và may mắn!', 'Phạm Ngọc Lan', '2024-12-16', 'blog_7.jpg'],
[
    "Trang Sức Bạc 925 - Lựa Chọn Tinh Tế Cho Phong Cách Hiện Đại",
    "Trang sức bạc Ý (Sterling Silver) không chỉ nổi bật với vẻ đẹp sáng bóng mà còn mang đến sự bền bỉ và giá trị thẩm mỹ cao. Được pha thêm hợp kim, bạc Ý đã trở thành lựa chọn phổ biến của nhiều tín đồ thời trang. 
    Cùng khám phá lý do vì sao trang sức bạc Ý luôn được ưa chuộng và cách chăm sóc chúng nhé!
    
    1. Vẻ Đẹp Hoàn Hảo Cho Mọi Phong Cách. Bạc Ý mang lại sự sang trọng và thanh lịch, dễ dàng kết hợp với nhiều loại trang phục:
    
    - **Công sở**: Dây chuyền bạc mảnh mai hoặc khuyên tai dáng nhỏ giúp tôn lên nét chuyên nghiệp.
    
    - **Sự kiện**: Các mẫu nhẫn bạc đính đá hoặc bông tai dáng dài tạo điểm nhấn hoàn hảo.
    
    - **Phong cách thường ngày**: Vòng tay bạc với thiết kế tối giản, phù hợp để sử dụng hàng ngày.
    
    2. Giá Trị Thực Tiễn . So với các dòng kim loại quý khác, bạc Ý có giá cả phải chăng hơn nhiều nhưng vẫn đảm bảo độ bền và tính thẩm mỹ cao. Đây là lựa chọn lý tưởng để đầu tư vào phụ kiện mà không ảnh hưởng quá nhiều đến ngân sách.
    
    3. Dễ Bảo Quản. Với các đặc tính ưu việt, bạc Ý dễ dàng được làm mới chỉ bằng vài bước đơn giản như sử dụng dung dịch vệ sinh chuyên dụng hoặc khăn mềm.
    
    4. Lời Kết: Trang sức bạc Ý không chỉ là món phụ kiện hoàn hảo mà còn là người bạn đồng hành lý tưởng trên hành trình thời trang của bạn. 
    Hãy lựa chọn những thiết kế phù hợp để thể hiện phong cách cá nhân và giữ gìn chúng đúng cách để luôn sáng đẹp như mới!",
    "Nguyễn Hà An",
    "2024-12-18",
    "blog_8.jpg"
],
[
    "Khám Phá Sức Hút Của Trang Sức Bạc Đính Đá",
    "Trang sức bạc đính đá là sự kết hợp hoàn hảo giữa ánh sáng thanh nhã của bạc và vẻ lung linh của đá quý. 
    Loại trang sức này không chỉ làm tôn lên nét quyến rũ mà còn mang lại giá trị ý nghĩa cho người sở hữu.
    
    1. Sự Độc Đáo Trong Thiết Kế. Trang sức bạc đính đá thường được chế tác với nhiều kiểu dáng độc đáo:
    
    - **Nhẫn bạc đính đá quý**: Tượng trưng cho tình yêu và sự cam kết.
    
    - **Dây chuyền bạc kèm mặt đá phong thủy**: Đem lại may mắn và bình an.
    
    - **Khuyên tai bạc đính pha lê**: Phù hợp để tạo điểm nhấn trong các buổi tiệc tối.
    
    2. Lý Do Trang Sức Bạc Đính Đá Được Yêu Thích
    
    - **Giá trị thẩm mỹ**: Sự kết hợp của bạc và đá quý tạo nên vẻ đẹp vượt thời gian.
    
    - **Phù hợp mọi dịp**: Dễ dàng phối hợp với nhiều phong cách từ dạo phố, công sở đến dự tiệc.
    
    3. Cách Chăm Sóc Trang Sức Bạc Đính Đá
    
    - **Vệ sinh nhẹ nhàng**: Sử dụng khăn mềm lau nhẹ nhàng quanh vùng đính đá.
    
    - **Bảo quản riêng biệt**: Tránh để trang sức va đập hoặc tiếp xúc hóa chất.
    
    4. Lời Kết :Trang sức bạc đính đá là lựa chọn tuyệt vời để tôn vinh vẻ đẹp và phong cách cá nhân. Nếu bạn đang tìm kiếm món phụ kiện hoàn hảo, đây chắc chắn là sự lựa chọn không thể bỏ qua!",
    "Lê Thị Minh Hương",
    "2024-12-20",
    "blog_9.jpg"
]
];
// Chuẩn bị câu lệnh SQL để chèn dữ liệu vào bảng blog
$stmt = $conn->prepare("INSERT INTO blog (ten_blog, noi_dung, tac_gia, ngay_dang, anh) VALUES (?, ?, ?, ?, ?)");

// Duyệt qua từng bài viết và chèn vào cơ sở dữ liệu
foreach ($blog_posts as $post) {
    // Liên kết các tham số và thực thi câu lệnh
    $stmt->bind_param("sssss", $post[0], $post[1], $post[2], $post[3], $post[4]);
    $stmt->execute();
}

// Kiểm tra việc chèn dữ liệu
echo "Dữ liệu bài viết đã được thêm thành công!";

// Đóng kết nối
$stmt->close();
$conn->close();
?>
