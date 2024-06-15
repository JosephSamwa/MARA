const express = require('express');
const nodemailer = require('nodemailer');
const bodyParser = require('body-parser');
const path = require('path');

const app = express();
const port = 3000;

app.use(bodyParser.json());
app.use(express.static(path.join(__dirname)));

app.post('/send-message', (req, res) => {
  const { name, email, message } = req.body;

  // Configure Nodemailer
  const transporter = nodemailer.createTransport({
    service: 'Gmail',
    auth: {
      user: 'your-email@gmail.com',
      pass: 'your-email-password'
    }
  });

  const mailOptions = {
    from: email,
    to: 'admin-email@example.com',
    subject: New message from ${name},
    text: message
  };

  transporter.sendMail(mailOptions, (error, info) => {
    if (error) {
      return res.status(500).send('Error sending message');
    }
    res.send('Message sent successfully');
  });
});

app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'contactUs.html'));
});

app.listen(port, () => {
  console.log(Server running at http://localhost:${port}/);
});
