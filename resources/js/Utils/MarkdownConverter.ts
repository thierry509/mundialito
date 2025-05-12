import Turndown from 'turndown';
import { marked } from 'marked';

export default class QuillConverter {
  private static turndown: Turndown;
  private static isInitialized = false;

  private static initialize() {
    if (this.isInitialized) return;

    // Configuration de Turndown (HTML → Markdown)
    this.turndown = new Turndown({
      headingStyle: 'atx',
      bulletListMarker: '-',
      codeBlockStyle: 'fenced',
      emDelimiter: '*',
      linkStyle: 'inlined',
      blankReplacement: (content, node) => {
        return node?.nodeName === 'P' ? '\n\n' : '';
      }
    });

    // Règles personnalisées
    this.turndown.addRule('underline', {
      filter: ['u', 'ins'],
      replacement: (content) => `<u>${content}</u>`
    });

    this.turndown.addRule('blockquote', {
      filter: 'blockquote',
      replacement: (content) => `> ${content.trim()}\n\n`
    });

    // Configuration de Marked (Markdown → HTML)
    marked.setOptions({
      gfm: true,
      breaks: false,
      headerIds: false,
      mangle: false
    });

    this.isInitialized = true;
  }

  static toMarkdown(html: string): string {
    this.initialize();

    // Nettoyage minimal du HTML spécifique à Quill
    const cleanedHtml = html
      .replace(/ class="[^"]*"/g, '')
      .replace(/ style="[^"]*"/g, '');

    return this.turndown.turndown(cleanedHtml).trim();
  }

  static toHtml(markdown: string): string {
    this.initialize();

    // Conversion Markdown → HTML
    let html = marked.parse(markdown);

    // Post-processing pour Quill
    html = html
      .replace(/<u>(.*?)<\/u>/g, '<span class="underline">$1</span>')
      .replace(/<p><\/p>/g, '<p><br></p>');

    return html;
  }

  static testRoundtrip(html: string): boolean {
    const markdown = this.toMarkdown(html);
    const newHtml = this.toHtml(markdown);
    return this.normalizeHtml(html) === this.normalizeHtml(newHtml);
  }

  private static normalizeHtml(html: string): string {
    return html
      .replace(/\s+/g, ' ')
      .replace(/> </g, '><')
      .trim();
  }
}
