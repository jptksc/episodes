# Episodes

Create simple video-centric websites.

![Alt text](screenshot.jpg?raw=true)

## Description

A simple flat-file solution for creating dynamic video-centric websites without the need for anything but your favorite text editor and video service (e.g. YouTube, Vimeo). For example, to publish a Vimeo video you would create “vimeo-129568177.txt” which would publish (title, text, embed code and thumbnail) on your Episodes powered site. Episodes also includes auto “plays” & “loves” counting, a fully functional contact form and even MailChimp integration for your newsletter. Episodes will function perfectly on any PHP compatible server.

## Setup

1. Update your text and options within “settings.php”.
4. Upload everything to any PHP compatable server.

## Posting Videos

Here’s how you post videos (YouTube and Vimeo are currently supported).

1. Create a new text file using the editor of your choice.
2. On the 1st line, add the video title (e.g. “Some Video”).
3. On the 3rd line, add the post date (e.g. “September 21st, 2015”).
4. On the 5th line, add the video text (only one line of text is supported for now).
5. Prefix your file name with the video service you’re using (e.g. “youtube-”).
6. End your file name with the video ID for the video you would like to embed.
7. You file name should look something like “youtube-5Qo0Q_91ZXg.txt” or “vimeo-110170664.txt”.
8. Upload your new file to the “content” directory on your site.
9. When you refresh your site, your video will be posted and a thumbnail image will automatically be generated for you.

## Services

If you need help developing the functionality you need for your own site, I'm available for hire to help you with whatever customization or implementation services you might need. To get started, just send me an email (jason@circa75.co).

## Version 1.0

- NEW: Initial release.

## License

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

