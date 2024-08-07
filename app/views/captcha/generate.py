from captcha.image import ImageCaptcha
from random import choice

alphabet = ['1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k',
            'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E',
            'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y',
            'Z']


pattern = ''.join(choice(alphabet) for i in range(4))


image_captcha = ImageCaptcha(width=300, height=200)
image_captcha.write(pattern, 'c:/xampp/htdocs/app/views/captcha/CAPTCHA.png')  



with open('c:/xampp/htdocs/app/views/captcha/encode.txt', 'w') as file:
    file.write(pattern+"\n")

    
    


