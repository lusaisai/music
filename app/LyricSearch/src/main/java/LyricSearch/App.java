package LyricSearch;

import java.sql.SQLException;

public class App 
{
    public static void main( String[] args ) throws SQLException {
        DBTalker db = new DBTalker();
        db.updateLyrics();
    }
}
