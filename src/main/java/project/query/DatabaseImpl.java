package project.query;

import java.util.LinkedList;
import java.util.List;
import java.sql.Statement;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;

public class DatabaseImpl implements Database {

    private final Connection connection;
    private Statement statement;
    private ResultSet resultSet;

    /***
     * Constructor
     * @param connection is the database's connection
     */
    public DatabaseImpl(Connection connection) {
        this.connection = connection;
    }

    @Override
    public List<String> getTableNames() {
        String query = "SELECT table_name" + "table_schema = 'bathhouse'";
        try {
            this.statement = this.connection.createStatement();
            this.resultSet = statement.executeQuery(query);
            return getList();
        } catch(SQLException e) {
            return List.of();
        }
    }

    private List<String> getList() throws SQLException {
        final List<String> list = new LinkedList<>();
        while(this.resultSet.next()) {
            list.add(this.resultSet.getString("table_name"));
        }
        return list;
    }

    @Override
    public Table getTable(String TableName) {
        // TODO Auto-generated method stub
        throw new UnsupportedOperationException("Unimplemented method 'getTable'");
    }

    @Override
    public boolean tryInsertRecord(String TableName, List<String> record) {
        // TODO Auto-generated method stub
        throw new UnsupportedOperationException("Unimplemented method 'tryInsertRecord'");
    }
    
}
