package LyricSearch;

public abstract class Lyricer {
    protected static final String AGENT = "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:29.0) Gecko/20100101 Firefox/29.0";

    public abstract String findLrcLyric( String artist, String title );
}
