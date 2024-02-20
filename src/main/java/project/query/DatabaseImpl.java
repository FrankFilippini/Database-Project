package project.query;

import java.util.List;
import java.sql.Connection;

public class DatabaseImpl implements Database {

    private final Connection connection;

    /***
     * Constructor
     * @param connection is the database's connection
     */
    public DatabaseImpl(Connection connection) {
        this.connection = connection;
    }

    @Override
    public List<String> getTableNames() {
        // TODO Auto-generated method stub
        throw new UnsupportedOperationException("Unimplemented method 'getTableNames'");
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
