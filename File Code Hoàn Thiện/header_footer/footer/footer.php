<!DOCTYPE html>
<html lang="en">
<head>
    <style>
                /* Đặt cấu hình chung */
        body {
            margin: 0; /* Loại bỏ toàn bộ margin mặc định của body */
            padding: 0; /* Loại bỏ toàn bộ padding mặc định của body */
            box-sizing: border-box; /* Áp dụng box-sizing để tính toán chính xác kích thước phần tử */
        }

        /* Footer */
        .footer-background {
            background-color:  #680707;;
            padding: 18px 0 6px;
            margin: 0; /* Loại bỏ khoảng cách mặc định */
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        .footer-content {
            max-width: 1224px;
            width: 100%;
        }

        .content-wrapper {
            display: flex;
            gap: 20px;
            padding:20px;
        }

        .info-column {
            display: flex;
            flex-direction: column;
            line-height: normal;
            width: 46%;
        }

        .contact-wrapper {
            display: flex;
            flex-direction: column;
            align-items: start;
            color: rgb(255, 255, 255);
            font: 15px 'Montserrat', sans-serif;
        }

        .brand-logo img {
            width: 60px;
            object-fit: contain;
        }

        .contact-header {
            font-size: 18px;
            font-weight: 700;
            margin-top: 46px;
        }

        .phone-number {
            font-weight: 500;
            margin-top: 21px;
        }

        .address-text {
            font-weight: 500;
            margin-top: 20px;
        }

        .social-link {
            display: flex;
            gap: 20px;
            margin-top: 25px;
        }

        .social-icon {
            width: 21px;
            height: auto;
        }

        .social-text {
            color: rgb(243, 184, 176);
            text-decoration: none;
        }

        .map-column {
            width: 54%;
        }

        .map-image {
            width: 100%;
            border-radius: 8px;
        }

        .copyright {
            color: rgb(255, 255, 255);
            margin-top: 20px;
            font: 100 15px/1 'Montserrat', sans-serif;
            text-align: center;
        }

        

        @media (max-width: 768px) {
            .footer-background {
                background-color:  #680707;;
                padding: 10px 0 3px;
                margin: 0; /* Loại bỏ khoảng cách mặc định */
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 100%;
            }
            
            .footer-content {
                max-width: 1224px;
                width: 100%;
            }
            
            .content-wrapper {
                padding: 0 10px; /* Thêm padding để cách lề 10px */
                display: flex;
                gap: 35px;
                
            }
            
            .info-column {
                display: flex;
                flex-direction: column;
                line-height: normal;
                width: 46%;
            }
            
            .contact-wrapper {
                display: flex;
                flex-direction: column;
                align-items: start;
                color: rgb(255, 255, 255);
                font: 8px 'Montserrat', sans-serif;
                padding-left: 20px;
            }
            
            .brand-logo img {
                width: 30px;
                object-fit: contain;
            }
            
            .contact-header {
                font-size: 8px;
                margin-top: 3px;
            }
            
            .phone-number {
                margin-top: 2px;
            }
            
            .address-text {
                margin-top: 2px;
            }
            
            .social-link {
                display: flex;
                gap: 4px;
                margin-top: 3px;
            }
            
            .social-icon {
                width: 8px;
                height: auto;
            }
            
            .social-text {
                color: rgb(243, 184, 176);
                text-decoration: none;
                font-size: 8px;
            }
            
            .map-column {
                width: 54%;
                padding-right: 0;
            }
            
            .map-image {
                width: 80%;
                border-radius: 8px;
                padding-top: 15px;
            }
            
            .copyright {
                color: rgb(255, 255, 255);
                margin-top: 2px;
                font: 100 8px/1 'Montserrat', sans-serif;
                text-align: center;
            }
            
        }
    </style>
</head>

<footer>
    <div class="footer-background">
        <div class="footer-content">
            <div class="content-wrapper">
                <div class="info-column">
                    <div class="contact-wrapper">
                        <div class="brand-logo">
                            <img src="logo.jpg" alt="Company Logo" class="logo-image">
                        </div>
                        <div class="contact-header">CONTACT INFO</div>
                        <div class="phone-number">Phone: 1234567890</div>
                        <div class="address-text">
                            Địa chỉ: 279 Nguyễn Tri Phương, Phường 05, Hồ Chí Minh - Quận 10
                        </div>
                        <div class="social-link">
                            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/6690d321558d9d2dc7cdcc5cb4f0a2cd1cd8483216c14d72b1bc67ab6287b7ad"
                                 class="social-icon" alt="Facebook icon">
                            <a href="https://www.facebook.com/profile.php?id=100016483540358&locale=vi_VN" class="social-text">Facebook</a>
                        </div>
                        <div class="social-link social-link-instagram">
                            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/131fbb2cab8623a4c31cc1cac88fe818531aa326bb5b99789506d85665e8ec63"
                                 class="social-icon" alt="Instagram icon">
                            <a href="https://www.instagram.com/_pvhthu/" class="social-text">Instagram</a>
                        </div>
                    </div>
                </div>
                <div class="map-column">
                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/d5fbe526928b28bbd74089f8e2639960a609a4a22625a7d20e1daa542c5640e3"
                         class="map-image" alt="Location map">
                </div>
            </div>
        </div>
        <div class="copyright">© 2024 Sản phẩm phát triển bởi BTJ</div>
    </div>
</footer>
</html>
