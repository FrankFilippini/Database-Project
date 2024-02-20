package project.query;

import java.util.List;

public interface Database {

    /***
     * @return tables' names
     */
    List<String> getTableNames();
    
    /****
     * @param TableName the name of the table that will be returned
     * @return the Table with the specified name
     */
    Table getTable(String TableName);

    /***
     * @param record the record to insert 
     * @param TableName the name of the table in which the record will be insert
     * @return if the record has been inserted or not
     */
    boolean tryInsertRecord(String TableName,List<String> record);

    //mancano i metodi per le query     (+ get per i nomi delle colonne di una certa table ????)
}