package LyricSearch;

import org.apache.commons.io.FileUtils;
import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

import java.io.File;
import java.io.IOException;
import java.net.URL;

public class Lrc123Lyricer extends Lyricer {
    private static final String SITE = "http://www.lrc123.com";
    private static final String URL_PRE = SITE + "/?field=all&keyword=";

    public String findLrcLyric(String artist, String title) {
        String url = URL_PRE + title.replaceAll("\\s+", "+") + "+" + artist.replaceAll("\\s+", "+");
        System.out.println(url);
        Document doc;
        int timeout = 20000;
        try {
            doc = Jsoup.connect(url)
                    .userAgent(AGENT)
                    .timeout(timeout)
                    .get();
        } catch (Exception e) {
            return "";
        }

        Elements contents = doc.select("a.O3");
        for(Element e: contents) {
            String href = e.attr("href");
            String link;
            if ( href.startsWith("http") ) {
                link = href;
            } else {
                link = SITE + href;
            }
            try {
                File tmp = File.createTempFile("Lrc123Lyricer", "lrcFile");
                FileUtils.copyURLToFile(new URL(link), tmp, timeout, timeout);
                tmp.deleteOnExit();
                String lyric = FileUtils.readFileToString(tmp, "GBK");
                if ( lyric.length() > 0 ) return lyric;
            } catch (IOException ignored) {}
        }

        return "";
    }
}
