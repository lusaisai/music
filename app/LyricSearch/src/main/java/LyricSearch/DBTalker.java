package LyricSearch;
import java.sql.*;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;
import java.util.concurrent.TimeUnit;

/**
 * Created with IntelliJ IDEA.
 * User: lusaisai
 * Date: 13-9-29
 */
public class DBTalker {
    private static final String USERNAME = "music";
    private static final String PASSWORD = "music";
    private static final String DATABASE = "music";
    private static final String URL = "jdbc:mysql://localhost:3306/" + DATABASE + "?characterEncoding=UTF-8";
    private Connection con;

    private static class Song {
        final int id;
        final String artist;
        final String name;

        Song(int id, String artist, String name) {
            this.id = id;
            this.artist = artist;
            this.name = name;
        }

        @Override
        public String toString() {
            return "Song{" +
                    "id=" + id +
                    ", artist='" + artist + '\'' +
                    ", name='" + name + '\'' +
                    "}<br/>";
        }
    }

    public DBTalker() throws SQLException {
        con = DriverManager.getConnection(URL,USERNAME,PASSWORD);
    }

    public void updateLyrics() {
        String query = "select\n" +
                "s.id, s.name as song_name, ar.name as artist_name\n" +
                "from songs s\n" +
                "join albums al\n" +
                "on   s.album_id = al.id\n" +
                "join artists ar\n" +
                "on   al.artist_id = ar.id\n" +
                "where s.lrc_lyric is null\n"
                ;
        try {
            Statement st = con.createStatement();
            ResultSet rs = st.executeQuery(query);
            ExecutorService es = Executors.newFixedThreadPool(15);
            while (rs.next()) {
                Song s = new Song( rs.getInt("id"), rs.getString("artist_name"), nameCleanUp(rs.getString("song_name")) );
                es.execute( new SearchLyrics(s, con) );
            }
            es.shutdown();

            try {
                es.awaitTermination(1, TimeUnit.HOURS);
            } catch (InterruptedException e) {
                es.shutdownNow();
            }
        } catch (SQLException e) {
            e.printStackTrace();  //To change body of catch statement use File | Settings | File Templates.
        }
    }

    private static class SearchLyrics implements Runnable {
        private Song song;
        private Connection conn;

        private SearchLyrics(Song song, Connection conn) {
            this.song = song;
            this.conn = conn;
        }

        @Override
        public void run() {
            try {
                Lyricer bLrc = new BaiduLyricer();
                Lyricer lLrc = new Lrc123Lyricer();
                PreparedStatement ps = conn.prepareStatement("update songs set lrc_lyric = ? where id = ?");

                String lrcLyric = bLrc.findLrcLyric(song.artist, song.name);
                if( lrcLyric.equals("") ) {
                    lrcLyric = lLrc.findLrcLyric(song.artist, song.name);
                }
                ps.setString(1,lrcLyric);
                ps.setInt(2,song.id);
                ps.executeUpdate();
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
    }


    public static String nameCleanUp(String input) {
        return input.replaceAll("^.*-","").trim()
                    .replaceAll("[0-9]+\\.*", "").trim()
                    .replaceAll("\\[.*\\]", "").trim()
                    .replaceAll("【.*】", "").trim()
                    .replaceAll("\\(.*\\)", "").trim()
                    .replaceAll("（.*）", "").trim()
                    .replaceAll("\\..*$", "").trim();
    }

}
