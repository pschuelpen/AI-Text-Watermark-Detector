<?php
#################################
#
#
# pschuelpen.group -- Watermark Detector (c)2025
# All rights reserved
# www.tec.pschuelpen.com/watermark-detector/
#
#
# Code by pschuelpen.group
#
# By: Philipp Schülpen
# E-Mail: support@pschuelpen.com
#
# 2025
#
#
#################################

# Use Session to disable that a reload triggers annoying Browser messages
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $_SESSION['text'] = $_POST['text'];
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit;
}
session_start();
$text = $_SESSION['text'] ?? '';

# Destroy Session to delete Session Data
session_unset();
session_destroy();

?>
<!--
#
# Code by pschuelpen.group
#
# By: Philipp Schülpen
# E-Mail: support@pschuelpen.com
#
# 2025
#
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="master.css">
    <title>AI-Text Watermark Detector</title>
</head>
<body>
    <div class="logo-container">
        <img src="psg_logo_b_pfad.svg" alt="Logo" style="max-width: 40px; height: auto;">
    </div>
    <h1>AI-Text Unicode Watermark Detector</h1>
    <form method="post">
        <textarea name="text" rows="8" placeholder="Paste your text here"><?= htmlspecialchars($text) ?></textarea>
        <input type="submit" value="Analyze">
    </form>

        <?php
        mb_internal_encoding("UTF-8");
        $pattern = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F-\x9F\x{00AD}\x{00A0}\x{200B}-\x{200F}\x{202A}-\x{202E}\x{2060}-\x{206F}\x{FEFF}]/u';

        $hasHidden = preg_match($pattern, $text);
        $cleanedText = preg_replace($pattern, '', $text);
        ?>

        <div class="output-section">
            <?php if (!empty($text)): ?>
            <p class="result_p"><strong><?= $hasHidden ? '❌ Invisible characters detected in the text.' : '✅ No invisible characters detected.' ?></strong></p>

            <?php if ($hasHidden): ?>
            <h2>Cleaned Text:</h2>
            <div class="clean-text" id="cleanTextBox"><?= htmlspecialchars($cleanedText) ?></div>
            <button class="copy-btn" onclick="copyCleanedText()">Copy Cleaned Text</button>

            <h2>Annotated Text:</h2>
            <div class="annotated-text">
                <?php
                $length = mb_strlen($text);
                for ($i = 0; $i < $length; $i++) {
                    $char = mb_substr($text, $i, 1);
                    $code = strtoupper(dechex(mb_ord($char, 'UTF-8')));
                    $codePoint = 'U+' . str_pad($code, 4, '0', STR_PAD_LEFT);
                    $isHiddenChar = preg_match($pattern, $char);
                    echo $isHiddenChar ? "<span class=\"hidden\">[{$codePoint}]</span>" : htmlspecialchars($char);
                }
                ?>
            </div>
            <?php endif; ?>

            <h2>Character Breakdown:</h2>
            <div class="char-breakdown-scroll">
                <?php
                $length = mb_strlen($text);
                for ($i = 0; $i < $length; $i++) {
                    $char = mb_substr($text, $i, 1);
                    $code = strtoupper(dechex(mb_ord($char, 'UTF-8')));
                    $codePoint = 'U+' . str_pad($code, 4, '0', STR_PAD_LEFT);
                    $hidden = preg_match($pattern, $char) || in_array($char, [" ", "\t", "\n", "\r"]);

                    $printChar = $char;
                    if ($char === " ") $printChar = "␣";
                    elseif ($char === "\n") $printChar = "␊";
                    elseif ($char === "\r") $printChar = "␍";
                    elseif ($char === "\t") $printChar = "⇥";
                    elseif (mb_ord($char) === 0x200B) $printChar = "ZWSP";

                    echo "<div class='char-box'>";
                    echo $hidden ? "<span class='hidden'>" : "";
                    echo "Char: <strong>" . htmlspecialchars($printChar) . "</strong> ";
                    echo $hidden ? "</span>" : "";
                    echo " | Unicode: $codePoint";
                    echo "</div>";
                }
                ?>
            </div>
            <?php endif; ?>
                <br><br>
            <section>
                <h2>Why is this important?</h2>
                <p> 
                    After an incident that ChatGPT falsely included hidden characters into some of their texts there is the 
                    possibility that users everywhere use these texts without knowing they have invisible watermarks planted 
                    inside. To prevent such an occurrence from happening this tool can identify invisible Unicode characters 
                    and delete them for you. 
                    <br><br> 
                    Especially for students that work with ChatGPT, Gemini and Depseek for their studies as well, it might be 
                    a good idea to double check before a thesis or something like that is somehow watermarked digitally!! 
                    <br><br> 
                    Use the tool with caution tho. There is not a 100% guarantee that this is reliable and meets the hidden 
                    watermark that AI uses. Maybe AI is even better detectable by choice of words, so this only covers Unicode 
                    watermarks. 
                </p>
            </section>

            <section>
                <h2>How does it work?</h2>
                <p> 
                    Text is represented as a sequence of Unicode characters. A wide variety of characters exists, including some 
                    that remain invisible in standard text. Researchers have demonstrated that invisible Unicode characters can be 
                    embedded in AI-generated responses as a form of watermarking, since they typically do not occur in genuine 
                    human-authored content.
                    <br><br> By detecting and removing these characters to the best of my ability, I try to ensure that your 
                    texts remain authentic and uncompromised. 
                </p>
            </section>

            <section>
                <h2>Privacy</h2>
                <p> 
                    The application is implemented in PHP, and no personal data—including any submitted text—is stored permanently. 
                    All submissions remain strictly confidential. 
                    <br><br> 
                    For transparency, the site initiates a session and temporarily retains the submitted text solely to prevent the browser’s 
                    “Resubmit form data” warning when reloading a page containing a previously submitted form, ensuring a seamless user 
                    experience. 
                    <br><br> 
                    For anyone interested in reviewing the tool’s source code, it is publicly available on GitHub. 
                </p>
            </section>

            <section>
                <h2>Disclaimer</h2>
                <p> 
                    Even if I respect your privacy I still advice you to generally never upload any sensitive data to any webpage on the
                    internet. If you need to check sensitive data host this page locally on your computer. You can find instructions for
                    this on Github.
                </p>
            </section>

            <section>
                <h2>Further Information</h2>
                <a href="https://www.rumidocs.com/newsroom/new-chatgpt-models-seem-to-leave-watermarks-on-text" target=”_blank”>New ChatGPT Models Seem to Leave Watermarks on Text</a>
                <a href="https://www.brookings.edu/articles/detecting-ai-fingerprints-a-guide-to-watermarking-and-beyond/" target=”_blank”>Detecting AI fingerprints: A guide to watermarking and beyond</a>
            </section>

            <section>
                <h2>Additionally</h2>
                <a href="https://www.soscisurvey.de/tools/view-chars.php" target=”_blank”>An alternate Tool doing the same thing</a>
                <a href="https://github.com/pschuelpen" target=”_blank”>My Github</a>
                <a href="https://pschuelpen.com/" target=”_blank”>My Website (Home)</a>
            </section>
        </div>

        <script>
        function copyCleanedText() {
            const text = document.getElementById("cleanTextBox").innerText;
            navigator.clipboard.writeText(text).then(() => {
                alert("Cleaned text copied to clipboard!");
            });
        }
        </script>
</body>
</html>