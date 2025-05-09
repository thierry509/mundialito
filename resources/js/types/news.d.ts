export interface NewsArticle {
    id: number;
    title: string;
    slug: string;
    content: string;
    date: string;
    category: string;
    excerpt: string | null;
    image_url: string | null;
    status: 'draft' | 'publish';
    user_id: number;
    created_at: string;
    updated_at: string;
  }

  export interface CreateNewsArticleDto {
    title: string;
    slug: string;
    content: string;
    date: string;
    category?: string;
    excerpt?: string;
    image_url?: string;
    status?: 'draft' | 'publish';
  }

  export interface UpdateNewsArticleDto {
    title?: string;
    content?: string;
    date?: string;
    category?: string;
    excerpt?: string;
    image_url?: string;
    status?: 'draft' | 'publish';
  }
