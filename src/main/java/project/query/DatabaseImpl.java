package project.query;

import java.util.Collection;
import java.util.LinkedList;
import java.util.List;
import java.util.Optional;
import java.util.stream.Stream;
import java.sql.Statement;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.ResultSetMetaData;
import java.sql.SQLException;
import java.sql.JDBCType;

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
            return getList();                               //get a list of result from a ResultSet
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
        String query = "SELECT * FROM" + TableName;
        try {
            this.statement = this.connection.createStatement();
            this.resultSet = statement.executeQuery(query);
            List<String> columnsNames = getColumnsNames(this.resultSet.getMetaData());
            List<List<String>> list = new LinkedList<>();
            list.add(columnsNames);
            list.addAll(getListFromResultSet());
            return new TableImpl(list);
        } catch (SQLException e) {
            return new TableImpl(List.of());
        }
    }

    private List<String> getColumnsNames(ResultSetMetaData metaData) throws SQLException {
        int count = metaData.getColumnCount();
        return Stream.iterate(1,i -> i <= count, i -> i+1)
                    .map(i -> {try {return metaData.getColumnName(i);} catch(SQLException e) { return "";}})
                    .toList();
    }

    private List<List<String>> getListFromResultSet() throws SQLException {
        final List<List<String>> list = new LinkedList<>();
        while(this.resultSet.next()) {
            list.add(getRecord());
        }
        return list;

    }

    private List<String> getRecord() throws SQLException {
        int count = this.resultSet.getMetaData().getColumnCount();
        final List<String> record = new LinkedList<>();
        for (int i=1; i<=count; i++){
            record.add(Optional.ofNullable(this.resultSet.getObject(i)).map(Object :: toString).orElse(""));
        }
        return record;
    }

    @Override
    public boolean tryInsertRecord(String TableName, List<String> record) {
        try {
            return Insert(TableName, record);
        } catch (SQLException e) {
            return false;
        }
    }

    private boolean Insert(String TableName, List<String> record) throws SQLException {
        List<String> modifiedRecord = new LinkedList<>(record);
        final List<String> nulls = modifiedRecord.stream().map(i -> (String)null).toList();
        final String qry = "SELECT * FROM" + TableName;    //creo una query per riutilizzare il metodo getColumnsNames per trovare il numero di colonne
        final Statement stmt = this.connection.createStatement();
        final ResultSet resSet = stmt.executeQuery(qry);
        int columnsNumber = getColumnsNames(resSet.getMetaData()).size();
        List<Integer> TypesOfTable = getTypes(TableName);
        return true; // da finire
    }

    private List<Integer> getTypes(String tableName) throws SQLException {
        String query = "SELECT DATA_TYPE" + "FROM INFORMATION_SCHEMA.COLUMNS" + "WHERE table_schema = 'bathhouse' AND table_name = '" + tableName + "'";   
        try {
            this.statement = this.connection.createStatement();
            this.resultSet = this.statement.executeQuery(query);
            List<Integer> list = new LinkedList<>();
            while(this.resultSet.next()) {
                list.add(getType(resultSet));
            }
            return list;
        } catch (SQLException e) {
            return List.of();
        }
    }

    private Integer getType(ResultSet resultSet) throws SQLException {
        if (resultSet.getString(1).equals("int")) {
            return JDBCType.INTEGER.getVendorTypeNumber();
        }
        return JDBCType.valueOf(resultSet.getString(1).toUpperCase()).getVendorTypeNumber();
    }
    
}
