<?php
include('includes/dbconnection.php');
session_start();
error_reporting(0);

if(isset($_POST['sub'])) {
    $email = $_POST['email'];
    $query = mysqli_query($con, "INSERT INTO tblsubscriber(Email) VALUES('$email')");
    
    if ($query) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    const toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        background: '#2a3439',
                        iconColor: '#d4a373',
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                    toast.fire({
                        icon: 'success',
                        title: 'Subscribed successfully!'
                    });
                });
              </script>";
    } else {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Subscription Failed',
                        text: 'Please try again later',
                        showConfirmButton: true,
                        confirmButtonColor: '#d4a373',
                        background: '#2a3439',
                        color: '#f8f5f2'
                    });
                });
              </script>";
    }
}
?>

<style>
    :root {
        --salon-dark: #2a3439;       /* Dark background from header */
        --salon-gold: #d4a373;       /* Gold accent color from header */
        --salon-light: #f8f5f2;      /* Light text color */
        --salon-medium: #6d6d7a;     /* Medium gray for secondary text */
        --transition: all 0.4s cubic-bezier(0.65, 0, 0.35, 1);
    }
    
    .salon-footer {
        background: var(--salon-dark);
        color: var(--salon-light);
        padding: 4rem 0 0;
        border-top: 1px solid rgba(212, 163, 115, 0.1);
    }
    
    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
    }
    
    .footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 3rem;
        margin-bottom: 3rem;
    }
    
    .footer-column {
        opacity: 0;
        transform: translateY(20px);
    }
    
    .footer-heading {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        color: var(--salon-gold);
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 0.5rem;
    }
    
    .footer-heading::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 2px;
        background: var(--salon-gold);
        transition: var(--transition);
    }
    
    .footer-column:hover .footer-heading::after {
        width: 80px;
    }
    
    .contact-list {
        list-style: none;
        padding: 0;
    }
    
    .contact-item {
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        transition: var(--transition);
    }
    
    .contact-item:hover {
        transform: translateX(5px);
    }
    
    .contact-icon {
        color: var(--salon-gold);
        margin-right: 1rem;
        font-size: 1.1rem;
        width: 20px;
        text-align: center;
    }
    
    .social-links {
        list-style: none;
        padding: 0;
    }
    
    .social-item {
        margin-bottom: 0.75rem;
    }
    
    .social-link {
        color: var(--salon-light);
        text-decoration: none;
        display: flex;
        align-items: center;
        transition: var(--transition);
    }
    
    .social-link:hover {
        color: var(--salon-gold);
    }
    
    .social-icon {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: rgba(212, 163, 115, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 0.75rem;
        transition: var(--transition);
    }
    
    .social-link:hover .social-icon {
        background: var(--salon-gold);
        color: var(--salon-dark);
    }
    
    .newsletter-text {
        margin-bottom: 1.5rem;
        color: var(--salon-medium);
        line-height: 1.6;
    }
    
    .newsletter-form {
        position: relative;
        max-width: 400px;
    }
    
    .newsletter-input {
        width: 100%;
        padding: 0.9rem 1.25rem;
        border: 1px solid rgba(212, 163, 115, 0.3);
        border-radius: 4px;
        background: rgba(255, 255, 255, 0.05);
        color: var(--salon-light);
        font-size: 1rem;
        transition: var(--transition);
    }
    
    .newsletter-input:focus {
        outline: none;
        border-color: var(--salon-gold);
        background: rgba(255, 255, 255, 0.1);
    }
    
    .newsletter-button {
        position: absolute;
        right: 4px;
        top: 4px;
        bottom: 4px;
        background: var(--salon-gold);
        color: var(--salon-dark);
        border: none;
        border-radius: 4px;
        padding: 0 1.5rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
    }
    
    .newsletter-button:hover {
        background: #c08e5a;
    }
    
    .footer-bottom {
        border-top: 1px solid rgba(212, 163, 115, 0.1);
        padding: 1.5rem 0;
        text-align: center;
    }
    
    .copyright {
        font-size: 0.9rem;
        color: var(--salon-medium);
    }
    
    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .footer-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        
        .footer-heading {
            font-size: 1.3rem;
        }
        
        .newsletter-form {
            max-width: 100%;
        }
    }
</style>

<div class="salon-footer">
    <div class="footer-container">
        <div class="footer-grid">
            <div class="footer-column" id="footer-address">
                <h3 class="footer-heading">Salon Location</h3>
                <ul class="contact-list">
                    <?php
                    $ret = mysqli_query($con, "SELECT * FROM tblpage WHERE PageType='contactus'");
                    while ($row = mysqli_fetch_array($ret)) {
                    ?>
                        <li class="contact-item">
                            <i class="fas fa-map-marker-alt contact-icon"></i>
                            <span><?php echo $row['PageDescription']; ?></span>
                        </li>
                        <li class="contact-item">
                            <i class="fas fa-phone-alt contact-icon"></i>
                            <span>+91 8849384716</span>
                        </li>
                        <li class="contact-item">
                            <i class="fas fa-envelope contact-icon"></i>
                            <span>madnisheth1234@gmail.com</span>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            
            <div class="footer-column" id="footer-hours">
                <h3 class="footer-heading">Working Hours</h3>
                <ul class="contact-list">
                    <li class="contact-item">
                        <i class="far fa-clock contact-icon"></i>
                        <span>Monday - Friday: 9AM - 8PM</span>
                    </li>
                    <li class="contact-item">
                        <i class="far fa-clock contact-icon"></i>
                        <span>Saturday: 10AM - 7PM</span>
                    </li>
                    <li class="contact-item">
                        <i class="far fa-clock contact-icon"></i>
                        <span>Sunday: 11AM - 5PM</span>
                    </li>
                </ul>
            </div>
            
            <div class="footer-column" id="footer-social">
                <h3 class="footer-heading">Follow Us</h3>
                <ul class="social-links">
                    <li class="social-item">
                        <a href="#" class="social-link">
                            <span class="social-icon"><i class="fab fa-instagram"></i></span>
                            <span>Instagram</span>
                        </a>
                    </li>
                    <li class="social-item">
                        <a href="#" class="social-link">
                            <span class="social-icon"><i class="fab fa-facebook-f"></i></span>
                            <span>Facebook</span>
                        </a>
                    </li>
                    <li class="social-item">
                        <a href="#" class="social-link">
                            <span class="social-icon"><i class="fab fa-whatsapp"></i></span>
                            <span>WhatsApp</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="footer-column" id="footer-newsletter">
                <h3 class="footer-heading">Newsletter</h3>
                <p class="newsletter-text">Subscribe for grooming tips, special offers, and salon updates.</p>
                <form method="post" class="newsletter-form">
                    <input type="email" name="email" class="newsletter-input" placeholder="Your email address" required>
                    <button type="submit" name="sub" class="newsletter-button">Subscribe</button>
                </form>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p class="copyright">© <?php echo date('Y'); ?> Men's Salon Management System. All rights reserved.</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Animate footer columns on scroll
    document.addEventListener('DOMContentLoaded', function() {
        const footerColumns = document.querySelectorAll('.footer-column');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, index * 150);
                }
            });
        }, { threshold: 0.1 });
        
        footerColumns.forEach(column => {
            observer.observe(column);
        });
    });
</script>