# AI-Text Watermark Detector

![image](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![image](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![image](https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white)

![License](https://img.shields.io/badge/license-MIT-blue)


## Why is this important?

After an incident that ChatGPT falsely included hidden characters into some of their texts there is the  possibility that users everywhere use these texts without knowing they have invisible watermarks planted inside. To prevent such an occurrence from happening this tool can identify invisible Unicode characters and delete them for you. 

Especially for students that work with ChatGPT, Gemini and Depseek for their studies as well, it might be a good idea to double check before a thesis or something like that is somehow watermarked digitally!! 

Use the tool with caution tho. There is not a 100% guarantee that this is reliable and meets the hidden watermark that AI uses. Maybe AI is even better detectable by choice of words, so this only covers Unicode watermarks.


## How does it work?

Text is represented as a sequence of Unicode characters. A wide variety of characters exists, including some that remain invisible in standard text. Researchers have demonstrated that invisible Unicode characters can be embedded in AI-generated responses as a form of watermarking, since they typically do not occur in genuine human-authored content.

By detecting and removing these characters to the best of my ability, I try to ensure that your texts remain authentic and uncompromised. 


## Demo

For a Live Demo of this Page please visit: [https://www.tools.pschuelpen.com/aitwm](https://www.tools.pschuelpen.com/aitwm)

Here you can paste in some text and see how the Page works ;)

> [!IMPORTANT]
> For sensitive requests I advice you to use a local installation

Even tho you can see the exact source Code here on GitHub, **never** upload sensitive information on webpages that you don't know !! Please host it locally

## Installation

There are several ways to host this Webpage. You can put it on a running webserver installation of yourself on any device, put it in custom docker containers or simply use my GitHub repository [Docker Webserver](https://github.com/pschuelpen/docker-webserver) to host it. The choice is yours ;)


## Additional

Have fun with the Tool !!


